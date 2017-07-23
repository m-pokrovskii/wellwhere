<style>
  body {
    position: absolute;
    background-image: url('/wp-content/themes/wellwhere/assets/img/pdf-background.jpg');
    background-image-resize: 6;
    margin: 0;
    padding: 0;
    width: 100%;
    height: 100%;
  }

  .pdfelement {
    position: absolute;
    color: #fff;
    font-family: 'Helvetica';
    font-size: 20px;
    text-transform: uppercase;
  }

  .name {
    top: 13.4mm;
    left: 40.6mm;
  }

  .gym-name {
    top: 34.2mm;
    left: 40.6mm;
  }

  .date {
    top: 13.4mm;
    left: 137.7mm;
    color: #000;
  }

  .entries {
    top: 34.2mm;
    left: 137.7mm;
    color: #000;
  }

  .pass {
    position: absolute;
    bottom: 50mm;
    left: 120.3mm;
    font-size: 60px;
    font-family: "Helvetica"
  }


</style>
<body>
  <div class="pdfelement name"><?php echo $user_name ?></div>
  <div class="pdfelement gym-name"><?php echo $gym_name ?></div>
  <div class="pdfelement date"><?php echo $expire ?></div>
  <div class="pdfelement entries"><?php echo $entries ?></div>
  <div class="pass"><?php echo $ticket_pass; ?></div>
</body>
