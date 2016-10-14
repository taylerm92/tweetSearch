<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
		<!-- Bootstrap MaxCDN and other css used -->
		<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="/tweetSearch/css/style.css">
  </head>
  <body>
    <?php

      $address = urlencode($_GET['streetAddress']);
      $url = 'http://maps.googleapis.com/maps/api/geocode/json?address='.$address.'&sensor=false';
      $geocode = file_get_contents($url);
      $results = json_decode($geocode, true);
      if($results['status']=='OK')
      {
        $lat = $results['results'][0]['geometry']['location']['lat'];
        $lng = $results['results'][0]['geometry']['location']['lng'];

        /*Twitter API Related*/
        require_once('TwitterAPIExchange.php');

        $settings = array (
          'oauth_access_token' => "781585131874160640-04qm8Dt5bmNxXjnkUvCnRGxUkNJJHWU",
          'oauth_access_token_secret' => "edqa9JyI25MjVglSbYCMTrX4QQiocoQO0gRaUSeYH7EMZ",
          'consumer_key' => "HZPFyaJM4FGxAeldqG4D72rnM",
          'consumer_secret' => "BcscOLNm4wErlMCULHcv2YCKuDENqYpE3PEHRC7NyzMe3pFW3h"
        );

        $url = "https://api.twitter.com/1.1/search/tweets.json";

        $requestMethod = "GET";

        $address = $_GET['streetAddress'];
        $keyword = $_GET['keyword'];
        $radius = $_GET['radius'];
        $geocode = $lat.','.$lng.','.$radius.'mi';
        $getfield = "?q=$keyword&geocode=$geocode&count=20";

        $twitter = new TwitterAPIExchange($settings);

        $string = json_decode($twitter->setGetfield($getfield)->buildOauth($url, $requestMethod)->performRequest(),TRUE);

        /*echo "<pre>";
        print_r($string);
        echo "</pre>";*/
        ?><div class="container"><?php
        ?><div class="title"><h3>20 Most Recent Tweets About #<?php echo $keyword ?> <br \> Near <?php echo $address?></h3>
        <div class="col-sm-12" style="text-align:center; padding-top: 40px;"> <!-- link to go back to the survey screen -->
  				<a href="index.php">Search another #</a>
  		  </div>
      </div>
        <br \><br \><br \><br \>
        <div class="tweets">
        <?php
        foreach($string['statuses'] as $item)
          {
              echo "<blockquote class=\"twitter-tweet\">";
              echo "<img src=\"" . $item['user']['profile_image_url'] . "\">";
              echo "  @".$item['user']['screen_name']."<br />";
              echo "Time and Date of Tweet: ".$item['created_at']."<br />";
              echo "Tweet: ". $item['text']."<br />";
              echo "Source: ". $item['source']."<br />";
              echo "Geo Location: ".$item['geo']['coordinates'][0]."  ".$item['geo']['coordinates'][1]."<br />";
              echo "Place: ". $item['place']['full_name']."<br />";
              echo "Tweeted by: ". $item['user']['name']."<br />";
              echo "Followers: ". $item['user']['followers_count']."<br />";
              echo "Friends: ". $item['user']['friends_count']."<br />";
              echo "Listed: ". $item['user']['listed_count']."<br />";
              echo "</blockquote><br />";
          }
        ?></div></div><?php
       }
      else
      {
        echo 'Couldnt find location!';
      }
    ?>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </body>
</html>
