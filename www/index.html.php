<?php

$this->region('title', 'RotoApp Demo');



$this->startRegion('footer') ?>
<p>
	Check out <strong>Roto</strong> on <a href="http://github.com/oranj/Roto">Github</a>
</p>
<?php $this->endregion();




echo $this->madlib->render();
