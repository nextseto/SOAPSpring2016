<!-- Again, Derek D and Kevin tryed to get Hybridauth working, no success - Kevin Bohinski 12/1/14-->
<?php
$config['HybridAuth'] = array(
    'providers' => array(
        'OpenID' => array(
            'enabled' => true
        )
    ),
    'debug_mode' => (bool)Configure::read('debug'),
    'debug_file' => LOGS . 'hybridauth.log',
);
