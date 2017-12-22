<?php
/**
 * Sample layout
 */

use Helpers\Assets;
use Helpers\Url;
use Helpers\Hooks;

//initialise hooks
$hooks = Hooks::get();
?>
<div class="text-center" style="margin-top: 50px">Felipe Hertzer - Regis Conrad</div>
</div>

<!-- JS -->
<?php
Assets::js(array(
	Url::templatePath() . 'js/jquery.js',
	Url::templatePath() . 'js/script.js',
	'//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'
));

//hook for plugging in javascript
$hooks->run('js');

//hook for plugging in code into the footer
$hooks->run('footer');
?>

</body>
</html>
