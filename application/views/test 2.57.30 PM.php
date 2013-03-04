<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>HTML5 Geolocation</title>
    <style type="text/css">
      div#map_container{
        width:100%;
        height:350px;
      }
      </style>
</head>

<body>

<p id = "xxx"> none </p>


<h1>HTML5 Geolocation Example</h1>

<span class="info">
  <p id="status">HTML5 Geolocation is <strong>not</strong> supported in your browser.</p>
</span>

<h2>Current Position:</h2>
<table border="1">
          <tr>
            <th width="40" scope="col"><h5 align="left">Lat.</h5></th>
             <td width="114" id="latitude">?</td>
          </tr>
          <tr>
            <td><h5>Long.</h5></td>
            <td id="longitude">?</td>
          </tr>
</table>
<div id="map_container">
    <span>Loading...</span>
</div>

        <?php require_once 'element/include_js.php'; ?>
        <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?v=3&sensor=true"></script>
</body>
</html>