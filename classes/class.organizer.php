<?php
// $current_path = dirname( __FILE__ ) ;
include 'inc/lang.php';
// print_r($language);

class organizer_page {

	public $language = [];
	// public $languages_long = [];

	private $html ='';

  
	function __construct($language = []){
	  if(!empty($language)){
		foreach($language as $language_iso => $value){
		  $this->__set($language_iso,$value);
		}
	  }
	}


	public function __set($language_iso, $value){ // set key and value in language property
		$this->language[$language_iso] = $value;
	}
  
	public function __get($language_iso){ // get property value
	  if(isset($this->language[$language_iso])) {
		  return $this->language[$language_iso];
	  }
	}
  
	public function getlanguage(){
	  return $this->language;
	}
  
  }
  
  $language = new organizer_page();
  $language-> en = 'EN';
  $language-> es = 'ES';
  $language-> nl = 'NL';
  
  // OR
  
//   $language = array(
// 	"1" => 'en',
// 	"2" => 'es',
// 	"3" => 'nl',
//   );

  
  $language = new organizer_page($language);
//   echo '<pre>'; print_r($language->getlanguage());
  $res = (object)$language->getlanguage();

  
//   echo '<pre>'; print_r($res);

// var_dump($language);
// print_r($language);
// sort($day_names);
// print_r($day_names);
// print_r($month_names);
// var_dump($languages_long);





	// <!-- // public function test(){
	// 	var_dump(get_object_vars($this));
	// 	}
	// }

	// // $test = new organizer;
	// // var_dump(get_object_vars($test));

	// // $test->test();

	// public $language = '';
	
	// public function __CONSTRUCT($language = 'en' )
	// {
	// 	$this ->language = $language;
	// }

	// private $html = ''; -->
// <!-- 
?>