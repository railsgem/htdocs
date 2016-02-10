
    <!-- Morris Charts JavaScript 
    <link rel="stylesheet" href="./demo_files/chosen.css">
    <script src="/bootstrap/js/plugins/morris/raphael.min.js"></script>
    <script src="/bootstrap/js/plugins/morris/morris.min.js"></script>
    <script src="/bootstrap/js/plugins/morris/morris-data.js"></script>-->
<select data-placeholder="Choose a Country..." class="chosen-select" style="width:350px;" tabindex="2">
    <option value=""></option>
    <option value="United States">United States</option>
    <option value="United Kingdom">United Kingdom</option>
    <option value="Afghanistan">Afghanistan</option>
    <option value="Aland Islands">Aland Islands</option>
    <option value="Albania">Albania</option>
    <option value="Algeria">Algeria</option>
    <option value="American Samoa">American Samoa</option>
    <option value="Andorra">Andorra</option>
    <option value="Angola">Angola</option>
    <option value="Anguilla">Anguilla</option>
    <option value="Antarctica">Antarctica</option>
    <option value="Antigua and Barbuda">Antigua and Barbuda</option>
    <option value="Argentina">Argentina</option>
    <option value="Armenia">Armenia</option>
    <option value="Aruba">Aruba</option>
    <option value="Australia">Australia</option>
    <option value="Austria">Austria</option>
    <option value="Azerbaijan">Azerbaijan</option>
  </select>

  <script type="text/javascript">
    var config = {
      '.chosen-select'           : {}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
  </script>