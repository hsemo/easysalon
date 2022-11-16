<?php
$title = 'Appointment';
$active = ''; // for active section either login or registration
$links = array(
// 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css',
'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css'
);
include("header.php");
?>

<div class="f-container">
  <form action="appointment.php" class="form-signup border rounded shadow-lg" method="post">
    <select name="city" id="city" class="form-select mb-3">
      <option value="none" selected="selected">Select salon</option>
      <?php
      for($i=1;$i<=10;$i++){
        echo "<option value=\"mandsaur\">Salon $i</option>";
      }
      ?>
    </select>
    <label for="time" class="h5">Choose time accordingly</label>
    <div class="input-group" id="time">
      <span class="input-group-text"><div class="icon"><i class="bi bi-clock"></i></div></span>
      <input type="number" class="form-control" name="hour" value="12" min="1" max="12">
      <input type="number" class="form-control" name="min" value="00" min="0" max="59">
      <select name="meridian" id="" class="form-select">
        <option value="am" selected>AM</option>
        <option value="pm">PM</option>
      </select>
    </div>

  </form>
</div>

<?php
// for adding extra js scripts
$scripts = array(
// 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js',
'https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js',
'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js',
'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js'
);

$script = "
\$(function () {
  \$('#datetimepicker').datetimepicker({
      format: 'hh:mm a'
  });
});
";
include("footer.php");
?>