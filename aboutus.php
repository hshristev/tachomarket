<?php
// Prevent direct access to file
defined('shoppingcart') or exit;
// Get all the categories from the database
$stmt = $pdo->query('SELECT * FROM categories');
$stmt->execute();
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
// Execute query to retrieve product options and group by the title

?>
<?=template_header('За нас')?>

<div >

    

<style>
    /* Basic Reset */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    

    h3{
        color: #f5f5f5; 
    }

    .container {
      max-width: 1100px;
      margin: 0 auto;
      background: #fff;
      border-radius: 8px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      padding: 30px;
    }

    .heading {
      text-align: center;
      margin-bottom: 20px;
    }

    .heading h1 {
      font-size: 2.4rem;
      color: #0086b1; /* Primary brand color */
      margin-bottom: 10px;
    }

    .heading p {
      font-size: 1.1rem;
      color: #555;
    }

    /* About Us Section */
    .about-section {
      margin-bottom: 40px;
    }

    .about-section h2 {
      font-size: 1.8rem;
      color: #f5874f; /* Secondary brand color */
      margin-bottom: 15px;
      border-bottom: 2px solid #f5874f;
      display: inline-block;
      padding-bottom: 5px;
    }

    .about-section p {
      font-size: 1rem;
      margin: 15px 0;
    }

    /* Contacts */
    .contacts-section {
      margin-bottom: 30px;
    }

    .contacts-section h2 {
      font-size: 1.8rem;
      color: #f5874f;
      margin-bottom: 15px;
      border-bottom: 2px solid #f5874f;
      display: inline-block;
      padding-bottom: 5px;
    }

    .office {
      background-color: #0086b1;
      color: #fff;
      padding: 15px;
      border-radius: 5px;
      margin-bottom: 10px;
    }

    .office h3 {
      font-size: 1.3rem;
      margin-bottom: 8px;
    }

    .office p {
      margin: 5px 0;
      font-size: 1rem;
    }

    #map {
      width: 100%;
      height: 600px; /* Adjust map height as needed */
      border-radius: 6px;
      border: 1px solid #ddd;
    }

    /* Responsive Adjustments */

  

    @media (max-width: 600px) {
      .heading h1 {
        font-size: 1.8rem;
      }
      .about-section h2, .contacts-section h2 {
        font-size: 1.4rem;
      }
      .office h3 {
        font-size: 1.1rem;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <!-- Page Heading -->
    <div class="heading">
      <h1 style="color:#10498d">ТАХОС ЕООД</h1>
      <p>Официален представител на Continental Automotive GmbH за България</p>
    </div>

    <!-- About Section -->
    <div class="about-section">
      <h2>За нас</h2>
      <p>
        ТАХОС ЕООД е тясно специализирана в областта на доставки, монтаж, 
        диагностика, калибриране, гаранционен и извънгаранционен сервиз 
        на тахографи и тахографско и сервизно оборудване на бранда <strong>VDO</strong>.
      </p>
      <p>
        Като официален представител на <strong>Continental Automotive GmbH</strong> 
        за България, ние предлагаме цялостни решения, съобразени с най-новите 
        европейски изисквания за контрол на времето за шофиране и почивка. 
        Нашият екип от сертифицирани специалисти гарантира професионална и 
        навременна поддръжка на тахографи за вашия автопарк.
      </p>
    </div>

    <div class="vdo-info" style="background-color: #f9f9f9; padding: 30px; margin: 30px auto; max-width: 100%; box-shadow: 0 2px 10px rgba(0,0,0,0.05); display: flex; align-items: center;">
  <div class="vdo-logo" style="margin-right: 20px;">
    <!-- Replace with your VDO logo; placeholder image used below -->
    <img src="uploads/VDO_logo.svg" alt="VDO Logo" style="max-width: 250px;">
  </div>
  <div class="vdo-text" style="flex: 1; margin-left: 40px;">
    <p style="font-weight: bold; margin-bottom: 10px;font-size: 21px;">VDO е търговска марка на Continental Corporation</p>
    <p>
      Continental разработва пионерски технологии и услуги за устойчива и свързана мобилност на хората и техните стоки. Основана през 1871 г., технологичната компания предлага безопасни, ефективни, интелигентни и достъпни решения за превозни средства, машини, трафик и транспорт.
    </p>
    <p>
      През 2019 г. Continental генерира продажби от 44,5 милиарда евро и в момента има повече от 233 000 служители в 59 страни и пазари. През 2021 г. компанията празнува своя 150-годишен юбилей.
    </p>
  </div>


</div>


    <!-- Contacts Section -->
    <div class="contacts-section">
      <h2>Контакти</h2>

      <!-- Central Office -->
      <!-- Central Office -->
<div class="office">
  <h3>Централен офис</h3>
  <p>Казичене, ул. Циклама 1В, сграда на МСК, ет.1, офис 106</p>
  <p><a href="tel:+359879297097" style="font-weight: bold; color: inherit; text-decoration: none;">+359 879 297097</a></p>
  <p><a href="tel:+359879346608" style="font-weight: bold; color: inherit; text-decoration: none;">+359 879 346608</a></p>
  <p><a href="tel:+359878533608" style="font-weight: bold; color: inherit; text-decoration: none;">+359 878 533608</a></p>
</div>

<!-- Sofia Service Base -->
<div class="office">
  <h3>Сервизна база София</h3>
  <p>Казичене, ул. Циклама 7</p>
  <p><a href="tel:+359878197097" style="font-weight: bold; color: inherit; text-decoration: none;">+359 878 197097</a></p>
  <p><a href="tel:+359879346608" style="font-weight: bold; color: inherit; text-decoration: none;">+359 879 346608</a></p>
</div>

<!-- Asenovgrad Service Base -->
<div class="office">
  <h3>Сервизна база Асеновград</h3>
  <p>Асеновград, кв. Долни Воден, ул. Захария – в двора на бивше АПК „Д.Воден“</p>
  <p><a href="tel:+359878474045" style="font-weight: bold; color: inherit; text-decoration: none;">+359 878 474045</a></p>
</div>

    </div>






    <div id="map" style="height: 500px; width: 100%;"></div>

<script>
  function initMap() {
    // Create the map centered near Sofia, Bulgaria.
    var map = new google.maps.Map(document.getElementById("map"), {
      center: { lat: 42.4, lng: 23.8219 },
      zoom: 8,
      mapTypeControl: true,
      mapTypeControlOptions: {
        style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
        position: google.maps.ControlPosition.TOP_LEFT,
        mapTypeIds: [
          google.maps.MapTypeId.ROADMAP,
          google.maps.MapTypeId.SATELLITE,
          google.maps.MapTypeId.TERRAIN
        ]
      },
      mapTypeId: google.maps.MapTypeId.ROADMAP,
      streetViewControl: true
    });

    // Define a custom marker symbol that looks like a pin in #0086b1.
    var customPin = {
      // This SVG path draws a typical map pin.
      path: "M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z M12 11.5c-1.38 0-2.5-1.12-2.5-2.5S10.62 6.5 12 6.5s2.5 1.12 2.5 2.5S13.38 11.5 12 11.5z",
      fillColor: "#0086b1",
      fillOpacity: 1,
      strokeColor: "#ffffff",
      strokeWeight: 1,
      scale: 1.5, // Adjust for desired size.
      anchor: new google.maps.Point(12, 22) // The anchor depends on the path dimensions.
    };

    // Define markers data including title and InfoWindow content.
    var markersData = [
      {
        position: { lat: 42.66460819525208, lng: 23.452993529919073 },
        title: "Централен офис",
        content: `
          <div style="max-width: 300px;">
            <h3 style="margin-bottom: 5px;color: #394352;">Централен офис</h3>
            <br>
            <p style="margin: 5px 0; line-height: 1.4;">
              София, Казчене<br>
              ул. "Циклама" 1В, <br>
              сграда на МСК, офис 106<br><br>
              <a href="tel:+359879346608" style="color: inherit; text-decoration: none;">+359 879 346608</a><br>
              <a href="tel:+359878533608" style="color: inherit; text-decoration: none;">+359 878 533608</a>
            </p>
            <div style="text-align: center; margin-top: 10px;">
              <a href="https://maps.app.goo.gl/UYH9DKCyxAhPbf3D6" target="_blank"
                 style="display: inline-block; background: #0086b1; color: #fff; padding: 8px 16px; text-decoration: none; border-radius: 4px;">
                Маршрут
              </a>
            </div>
          </div>
        `
      },
      {
        position: { lat: 42.66286635505061, lng: 23.44933449571845 },
        title: "Сервизна база СОФИЯ",
        content: `
          <div style="max-width: 300px;">
            <h3 style="margin-bottom: 5px;color: #394352;">Сервизна база София</h3>
            <br>
            <p style="margin: 5px 0;">
              София, Казичене<br>
              ул. "Циклама" 7<br>
              <a href="tel:+359878197097" style="color: inherit; text-decoration: none;">+359 878 197097</a><br>
              <a href="tel:+359878533608" style="color: inherit; text-decoration: none;">+359 878 533608</a>
            </p>
            <div style="text-align: center; margin-top: 10px;">
              <a href="https://maps.app.goo.gl/cDF7hKomJupii66W8" target="_blank"
                 style="display: inline-block; background: #0086b1; color: #fff; padding: 8px 16px; text-decoration: none; border-radius: 4px;">
                Маршрут
              </a>
            </div>
          </div>
        `
      },
      {
        position: { lat: 42.031020935746, lng: 24.842766879074368 },
        title: "Сервизна база Асеновград",
        content: `
          <div style="max-width: 300px;">
            <h3 style="margin-bottom: 5px;color: #394352;">Сервизна база Асеновград</h3>
            <br>
            <p style="margin: 5px 0; line-height: 1.4;">
              Асеновград<br>
              кв. Долни Воден, <br>
              ул. "Захария" – <br>
              в двора на бивше АПК<br><br>
              <a href="tel:+359878474045" style="color: inherit; text-decoration: none;">+359 878 474045</a>
            </p>
            <div style="text-align: center; margin-top: 10px;">
              <a href="https://maps.app.goo.gl/mCeL3kncd6iHpW6g7" target="_blank"
                 style="display: inline-block; background: #0086b1; color: #fff; padding: 8px 16px; text-decoration: none; border-radius: 4px;">
                Маршрут
              </a>
            </div>
          </div>
        `
      }
    ];

    // Loop through markersData to create markers with the custom pin.
    markersData.forEach(function(item) {
      var marker = new google.maps.Marker({
        position: item.position,
        map: map,
        title: item.title,
        icon: customPin
      });

      var infoWindow = new google.maps.InfoWindow({
        content: item.content
      });

      marker.addListener("click", function() {
        infoWindow.open(map, marker);
      });
    });
  }
</script>

<!-- Load the Google Maps API with your key and callback -->
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB8mYbsO6_yasf3QYI_qd1p_ngaWKCE9Ew&callback=initMap"></script>





  </div>

  



<?=template_footer()?>