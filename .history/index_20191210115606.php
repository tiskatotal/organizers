<?php

ob_start();
$date = new DateTime();
// $day = $date->format('N'); // Day of the month, 2 digits with leading zeros 01 to 31    
$month = $date->format('m'); //Numeric representation of a month, with leading zeros 01 through 12  
$year = $date->format('Y'); //A full numeric representation of a year, 4 digits 1999 or 2003

if (isset($_REQUEST['day'])) {
    $day = $_REQUEST['day'];
}

if (isset($_REQUEST['month'])) {
	$month = $_REQUEST['month'];
}
if (isset($_REQUEST['year'])) {
	$year = $_REQUEST['year'];
}

$date->setDate($year, $month, 1);

// $week_days = array(1 => 'monday', 2 => 'tuesday', 3 => 'wednesday', 4 => 'thursday', 5 => 'friday', 6 => 'saturday', 7 => 'sunday');
$week_days = array('monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday');

$months = array(1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April', 5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August', 9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December');

$days_in_month = $date->format('d-m-Y'); // t is number of days in given month 28 through 31

$last_day_month = $date->format('t'); //number of days in given  month
$first_day_month = $date->format('N'); //Starts the month on the right weekday 1 for monday 7 sunday
$start_month_day = $date->format('D'); // textual representation
$current_cells = array();
$years = range(2019, 2030);
?>

<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<title>TimeTracker</title>
	<link rel="stylesheet" href="css/timetracker.css" />
</head>

<body>	
	<table>
		<thead>
			<tr>
				<th colspan="8">
					<?php print($months[$month] . ' ' . $year); 
					?>
				</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th> Week</th>
				<?php
				foreach ($week_days as $key => $value) {
					print '<th>' . $value . '</th>';
				}
				?>
			</tr>
				<?php
					$current_week = $date->format('W'); // ISO week numbers in years
					$current_day = 1;
					while ($current_day <= $last_day_month) {
						print '<tr>';
						print '<th>' . $current_week . '</th>';
						
						$painted_cells = 0;
						// Nos faltan los 7 días L a D
						if ($current_day == 1) {
							for ($empty_cell = 1; $empty_cell < $first_day_month; $empty_cell++) {
								print '<td></td>';
								$painted_cells++;
							}
						}
						// paint a cell for every day of the month
						for ($painted_cells; $painted_cells < 7; $painted_cells++) {
							if ($current_day <= $last_day_month) {
								print '<td>' . $current_day . '</td>';
							} else {
								print '<td></td>';
							}
							$current_day++;
						}
						$current_week++;
						print '</tr>';
					}
				?>
		</tbody>
		<!-- <tfoot>
			<tr>
				<td> 
					<!-- <p>
						En Torremanzanas a <?php
						print($last_day_month . ' de ' . $months[$month] . ' de ' . $year); ?>
					</p> -->
				</td>
			</tr>
		</tfoot> -->
	</table>	
</body>
</div>
<pagebreak />
</html>
<?php
$html = ob_get_clean();
?>

<?php
require_once __DIR__ . '/vendor/autoload.php';

// $numero = 20;
// $html = '
// <div class="prueba">
// El número es '.$numero.'
// </div>';

// $html .= "<div>Prueba</div>";

// $mpdf = new \Mpdf\Mpdf([
//     'format' => 'A4-L',
//     'margin_left' => 0,
//     'margin_right' => 0,
//     'margin_top' => 0,
//     'margin_bottom' => 0,
//     'margin_header' => 0,
//     'margin_footer' => 0,
// ]);

// $mpdf->SetImportUse();

// $ow = $mpdf->h;
// $oh = $mpdf->w;
// $pw = $mpdf->w / 2;
// $ph = $mpdf->h;

// $mpdf->SetDisplayMode('fullpage');

// $pagecount = $mpdf->SetSourceFile('1 enero 19 di 1.pdf');
// $pp = GetBookletPages($pagecount);

// foreach ($pp as $v) {
//     $mpdf->AddPage();

//     if ($v[0] > 0 && $v[0] &le; $pagecount) {
//         $tplIdx = $mpdf->ImportPage($v[0], 0, 0, $ow, $oh);
//         $mpdf->UseTemplate($tplIdx, 0, 0, $pw, $ph);
//     }

//     if ($v[1] > 0 && $v[1] &le; $pagecount) {
//         $tplIdx = $mpdf->ImportPage($v[1], 0, 0, $ow, $oh);
//         $mpdf->UseTemplate($tplIdx, $pw, 0, $pw, $ph);
//     }
// }

// $mpdf->Output();
// exit;

// function GetBookletPages($np, $backcover = true) {
//     $lastpage = $np;
//     $np = 4 * ceil($np / 4);
//     $pp = array();

//     for ($i = 1; $i &le; $np / 2; $i++) {

//         $p1 = $np - $i + 1;

//         if ($backcover) {
//             if ($i == 1) {
//                 $p1 = $lastpage;
//             } elseif ($p1 &ge; $lastpage) {
//                 $p1 = 0;
//             }
//         }

//         $pp[] = ($i % 2 == 1)
//             ? array( $p1,  $i );
//             : array( $i, $p1 );
//     }

//     return $pp;
// }

$invoice_nos = ['0' => $html, '1' => $html, '2' => $html];

$this->mpdf= new mPDF('TH','A4');
$this->mpdf->defaultheaderfontsize=12;
$this->mpdf->defaultheaderfontstyle='B';
$this->mpdf->defaultheaderline=0;
$this->mpdf->setFooter($footer);
$this->mpdf->SetHeader('Bill | | <strong>Pages {PAGENO} of {nb}</strong>');

foreach ($invoice_nos as $key => $invoice_no) {

 $this->mpdf->AddPage();
 $this->mpdf->WriteHTML($html);
}

$this->mpdf->defaultfooterline=0;
$this->mpdf->Output();
$this->mpdf->Output('.date('Y-m-d').'.pdf','F');



// $mpdf = new \Mpdf\Mpdf();
// $mpdf = new \Mpdf\Mpdf([
//     'mode' => 'utf-8',
//     'format' => 'A4-L',
//     'orientation' => 'L'
// ]);

// // $mpdf->WriteHTML('<h1>Hello world!</h1>');
// $mpdf->WriteHTML($html);
// $mpdf->AddPage();
// $mpdf->SetHeader('timetraker 2020 | | <strong>Pages {PAGENO} of {nb}</strong>');

// $mpdf->Output();
// ?>

<?php
$html = '
<html><head>
	<meta http-equiv="Content-Language" content="en-GB">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<style>
		body { font-family:"Times New Roman"; font-size:14pt; }
		p { margin: 0; }
	</style>
</head><body>
<!-- SECTION 1 -->
<h1>mPDF Example Booklet</h1>
<p>Nulla felis erat, imperdiet eu, ullamcorper non, nonummy quis, elit. Suspendisse potenti. Ut a eros at ligula vehicula pretium. Maecenas feugiat pede vel risus. Nulla et lectus. Fusce eleifend neque sit amet erat. Integer consectetuer nulla non orci. Morbi feugiat pulvinar dolor. Cras odio. Donec mattis, nisi id euismod auctor, neque metus pellentesque risus, at eleifend lacus sapien et risus. Phasellus metus. Phasellus feugiat, lectus ac aliquam molestie, leo lacus tincidunt turpis, vel aliquam quam odio et sapien. Mauris ante pede, auctor ac, suscipit quis, malesuada sed, nulla. Integer sit amet odio sit amet lectus luctus euismod. Donec et nulla. Sed quis orci. </p>
<p>Sed bibendum. Nunc eleifend ornare velit. Sed consectetuer urna in erat. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Mauris sodales semper metus. Maecenas justo libero, pretium at, malesuada eu, mollis et, arcu. Ut suscipit pede in nulla. Praesent elementum, dolor ac fringilla posuere, elit libero rutrum massa, vel tincidunt dui tellus a ante. Sed aliquet euismod dolor. Vestibulum sed dui. Duis lobortis hendrerit quam. Donec tempus orci ut libero. Pellentesque suscipit malesuada nisi. </p>
<h4>Little Women - Chapter One - Playing Pilgrims</h4>
<p> Christmas won\'t be Christmas without any presents,  grumbled Jo, lying on the rug.</p><p> It\'s so dreadful to be poor!  sighed Meg, looking down at her old dress.</p><p> I don\'t think it\'s fair for some girls to have plenty of pretty things, and other girls nothing at all,  added little Amy, with an injured sniff.</p><p> We\'ve got Father and Mother, and each other,  said Beth contentedly from her corner.</p><p>The four young faces on which the firelight shone brightened at the cheerful words, but darkened again as Jo said sadly,  We haven\'t got Father, and shall not have him for a long time.  She didn\'t say  perhaps never,  but each silently added it, thinking of Father far away, where the fighting was.</p><p>Nobody spoke for a minute; then Meg said in an altered tone,  You know the reason Mother proposed not having any presents this Christmas was because it is going to be a hard winter for everyone; and she thinks we ought not to spend money for pleasure, when our men are suffering so in the army. We can\'t do much, but we can make our little sacrifices, and ought to do it gladly. But I am afraid I don\'t  And Meg shook her head, as she thought regretfully of all the pretty things she wanted.</p><p> But I don\'t think the little we should spend would do any good. We\'ve each got a dollar, and the army wouldn\'t be much helped by our giving that. I agree not to expect anything from Mother or you, but I do want to buy UNDINE AND SINTRAM for myself. I\'ve wanted it so long,  said Jo, who was a bookworm.</p><p> I planned to spend mine in new music,  said Beth, with a little sigh, which no one heard but the hearth brush and kettle holder.</p><p> I shall get a nice box of Faber\'s drawing pencils. I really need them,  said Amy decidedly.</p><p> Mother didn\'t say anything about our money, and she won\'t wish us to give up everything. Let\'s each buy what we want, and have a little fun. I\'m sure we work hard enough to earn it,  cried Jo, examining the heels of her shoes in a gentlemanly manner.</p><p> I know I do&mdash;teaching those tiresome children nearly all day, when I\'m longing to enjoy myself at home,  began Meg, in the complaining tone again.</p><p> You don\'t have half such a hard time as I do,  said Jo.  How would you like to be shut up for hours with a nervous, fussy old lady, who keeps you trotting, is never satisfied, and worries you till you you\'re ready to fly out the window or cry? </p><p> It\'s naughty to fret, but I do think washing dishes and keeping things tidy is the worst work in the world.  It makes me cross, and my hands get so stiff, I can\'t practice well at all.  And Beth looked at her rough hands with a sigh that any one could hear that time.</p><p> I don\'t believe any of you suffer as I do,  cried Amy,  for you don\'t have to go to school with impertinent girls, who plague you if you don\'t know your lessons, and laugh at your dresses, and label your father if he isn\'t rich, and insult you when your nose isn\'t nice. </p><p> If you mean libel, I\'d say so, and not talk about labels, as if Papa was a pickle bottle,  advised Jo, laughing.</p><p> I know what I mean, and you needn\'t be satirical about it. It\'s proper to use good words, and improve your vocabulary,  returned Amy, with dignity.</p><p> Don\'t peck at one another, children. Don\'t you wish we had the money Papa lost when we were little, Jo? Dear me! How happy and good we\'d be, if we had no worries!  said Meg, who could remember better times.</p><p> You said the other day you thought we were a deal happier than the King children, for they were fighting and fretting all the time, in spite of their money. </p><p> So I did, Beth. Well, I think we are. For though we do have to work, we make fun of ourselves, and are a pretty jolly set, as Jo would say. </p><p> Jo does use such slang words!   observed Amy, with a reproving look at the long figure stretched on the rug.</p><p>Jo immediately sat up, put her hands in her pockets, and began to whistle.</p><p> Don\'t, Jo. It\'s so boyish! </p><p> That\'s why I do it. </p><p> I detest rude, unladylike girls! </p><p> I hate affected, niminy-piminy chits! </p><p> Birds in their little nests agree,  sang Beth, the peacemaker, with such a funny face that both sharp voices softened to a laugh, and the  pecking  ended for that time.</p><p> Really, girls, you are both to be blamed,  said Meg, beginning to lecture in her elder-sisterly fashion. You are old enough to leave off boyish tricks, and to behave better, Josephine. It didn\'t matter so much when you were a little girl, but now you are so tall, and turn up your hair, you should remember that you are a young lady. </p><p> I\'m not!  And if turning up my hair makes me one, I\'ll wear it in two tails till I\'m twenty,  cried Jo, pulling off her net, and shaking down a chestnut mane.   I hate to think I\'ve got to grow up, and be Miss March, and wear long gowns, and look as prim as a China Aster! It\'s bad enough to be a girl, anyway, when I like boy\'s games and work and manners! I can\'t get over my disappointment in not being a boy. And it\'s worse than ever now, for I\'m dying to go and fight with Papa. And I can only stay home and knit, like a poky old woman! </p><p>And Jo shook the blue army sock till the needles rattled like castanets, and her ball bounded across the room.</p><p> Poor Jo! It\'s too bad, but it can\'t be helped. So you must try to be contented with making your name boyish, and playing brother to us girls,  said Beth, stroking the rough head with a hand that all the dish washing and dusting in the world could not make ungentle in its touch.</p><p> As for you, Amy,  continued Meg,  you are altogether to particular and prim. Your airs are funny now, but you\'ll grow up an affected little goose, if you don\'t take care. I I like your nice manners and refined ways of speaking, when you don\'t try to be elegant. But your absurd words are as bad as Jo\'s slang. </p><p> If Jo is a tomboy and Amy a goose, what am I, please?  asked Beth, ready to share the lecture.</p><p> You\'re a dear, and nothing else,  answered Meg warmly, and no one contradicted her, for the \'Mouse\' was the pet of the family.</p>
<h4>Little Women - Chapter One - Playing Pilgrims</h4>
<p> Christmas won\'t be Christmas without any presents,  grumbled Jo, lying on the rug.</p><p> It\'s so dreadful to be poor!  sighed Meg, looking down at her old dress.</p><p> I don\'t think it\'s fair for some girls to have plenty of pretty things, and other girls nothing at all,  added little Amy, with an injured sniff.</p><p> We\'ve got Father and Mother, and each other,  said Beth contentedly from her corner.</p><p>The four young faces on which the firelight shone brightened at the cheerful words, but darkened again as Jo said sadly,  We haven\'t got Father, and shall not have him for a long time.  She didn\'t say  perhaps never,  but each silently added it, thinking of Father far away, where the fighting was.</p><p>Nobody spoke for a minute; then Meg said in an altered tone,  You know the reason Mother proposed not having any presents this Christmas was because it is going to be a hard winter for everyone; and she thinks we ought not to spend money for pleasure, when our men are suffering so in the army. We can\'t do much, but we can make our little sacrifices, and ought to do it gladly. But I am afraid I don\'t  And Meg shook her head, as she thought regretfully of all the pretty things she wanted.</p><p> But I don\'t think the little we should spend would do any good. We\'ve each got a dollar, and the army wouldn\'t be much helped by our giving that. I agree not to expect anything from Mother or you, but I do want to buy UNDINE AND SINTRAM for myself. I\'ve wanted it so long,  said Jo, who was a bookworm.</p><p> I planned to spend mine in new music,  said Beth, with a little sigh, which no one heard but the hearth brush and kettle holder.</p><p> I shall get a nice box of Faber\'s drawing pencils. I really need them,  said Amy decidedly.</p><p> Mother didn\'t say anything about our money, and she won\'t wish us to give up everything. Let\'s each buy what we want, and have a little fun. I\'m sure we work hard enough to earn it,  cried Jo, examining the heels of her shoes in a gentlemanly manner.</p><p> I know I do&mdash;teaching those tiresome children nearly all day, when I\'m longing to enjoy myself at home,  began Meg, in the complaining tone again.</p><p> You don\'t have half such a hard time as I do,  said Jo.  How would you like to be shut up for hours with a nervous, fussy old lady, who keeps you trotting, is never satisfied, and worries you till you you\'re ready to fly out the window or cry? </p><p> It\'s naughty to fret, but I do think washing dishes and keeping things tidy is the worst work in the world.  It makes me cross, and my hands get so stiff, I can\'t practice well at all.  And Beth looked at her rough hands with a sigh that any one could hear that time.</p><p> I don\'t believe any of you suffer as I do,  cried Amy,  for you don\'t have to go to school with impertinent girls, who plague you if you don\'t know your lessons, and laugh at your dresses, and label your father if he isn\'t rich, and insult you when your nose isn\'t nice. </p><p> If you mean libel, I\'d say so, and not talk about labels, as if Papa was a pickle bottle,  advised Jo, laughing.</p><p> I know what I mean, and you needn\'t be satirical about it. It\'s proper to use good words, and improve your vocabulary,  returned Amy, with dignity.</p><p> Don\'t peck at one another, children. Don\'t you wish we had the money Papa lost when we were little, Jo? Dear me! How happy and good we\'d be, if we had no worries!  said Meg, who could remember better times.</p><p> You said the other day you thought we were a deal happier than the King children, for they were fighting and fretting all the time, in spite of their money. </p><p> So I did, Beth. Well, I think we are. For though we do have to work, we make fun of ourselves, and are a pretty jolly set, as Jo would say. </p><p> Jo does use such slang words!   observed Amy, with a reproving look at the long figure stretched on the rug.</p><p>Jo immediately sat up, put her hands in her pockets, and began to whistle.</p><p> Don\'t, Jo. It\'s so boyish! </p><p> That\'s why I do it. </p><p> I detest rude, unladylike girls! </p><p> I hate affected, niminy-piminy chits! </p><p> Birds in their little nests agree,  sang Beth, the peacemaker, with such a funny face that both sharp voices softened to a laugh, and the  pecking  ended for that time.</p><p> Really, girls, you are both to be blamed,  said Meg, beginning to lecture in her elder-sisterly fashion. You are old enough to leave off boyish tricks, and to behave better, Josephine. It didn\'t matter so much when you were a little girl, but now you are so tall, and turn up your hair, you should remember that you are a young lady. </p><p> I\'m not!  And if turning up my hair makes me one, I\'ll wear it in two tails till I\'m twenty,  cried Jo, pulling off her net, and shaking down a chestnut mane.   I hate to think I\'ve got to grow up, and be Miss March, and wear long gowns, and look as prim as a China Aster! It\'s bad enough to be a girl, anyway, when I like boy\'s games and work and manners! I can\'t get over my disappointment in not being a boy. And it\'s worse than ever now, for I\'m dying to go and fight with Papa. And I can only stay home and knit, like a poky old woman! </p><p>And Jo shook the blue army sock till the needles rattled like castanets, and her ball bounded across the room.</p><p> Poor Jo! It\'s too bad, but it can\'t be helped. So you must try to be contented with making your name boyish, and playing brother to us girls,  said Beth, stroking the rough head with a hand that all the dish washing and dusting in the world could not make ungentle in its touch.</p><p> As for you, Amy,  continued Meg,  you are altogether to particular and prim. Your airs are funny now, but you\'ll grow up an affected little goose, if you don\'t take care. I I like your nice manners and refined ways of speaking, when you don\'t try to be elegant. But your absurd words are as bad as Jo\'s slang. </p><p> If Jo is a tomboy and Amy a goose, what am I, please?  asked Beth, ready to share the lecture.</p><p> You\'re a dear, and nothing else,  answered Meg warmly, and no one contradicted her, for the \'Mouse\' was the pet of the family.</p>
</body></html>';
//==============================================================
//==============================================================
//==============================================================
// required to load FPDI classes
require_once __DIR__ . '/bootstrap.php';
$mpdf = new \Mpdf\Mpdf([
	'mode' => 'c',
	'margin_left' => 32,
	'margin_right' => 25,
	'margin_top' => 27,
	'margin_bottom' => 25,
	'margin_header' => 16,
	'margin_footer' => 16
]);
$mpdf->mirrorMargins = 1;
$mpdf->SetDisplayMode('fullpage','two');
$mpdf->onlyCoreFonts = true;
$mpdf->defaultfooterfontsize = 13;
$mpdf->AddPage();
$mpdf->Image('assets/clematis.jpg',0,0,210,297,'jpg','',true, false);	// e.g. the last "false" allows a full page picture
$mpdf->y = 70;
$mpdf->Shaded_box('mPDF Example File', 'Arial', '', 28, '70%', 'DF', 3, '#FFFFFF', '#000044', 10);
$mpdf->AddPage();
$mpdf->SetFooter('{PAGENO}');
$mpdf->WriteHTML($html);
$mpdf->AddPage('','NEXT-EVEN');
$mpdf->SetFooter();
$mpdf->SetAlpha(0.5);
$mpdf->Image('assets/clematis.jpg',0,0,210,297,'jpg','',true, false);	// e.g. the last "false" allows a full page picture
$mpdf->SetAlpha(1);
$mpdf->writeBarcode('978-0-9542246-0-8', 1, 130, 230, 1,0, 3,3,4,4);
// Save the pages to a file
$mpdf->Output('test.pdf', 'F');
function GetBookletPages($np, $backcover=true) {
	$lastpage = $np;
	$np = 4*ceil($np/4);
	$pp = array();
	for ($i=1; $i<=$np/2; $i++) {
		$p1 = $np - $i + 1;
		if ($backcover) {
			if ($i == 1) { $p1 = $lastpage; }
			else if ($p1 >= $lastpage) { $p1 = 0; }
		}
		if ($i % 2 == 1) {
			$pp[] = array( $p1,  $i );
		}
		else {
			$pp[] = array( $i, $p1 );
		}
	}
	return $pp;
}
$mpdf = new \Mpdf\Mpdf([
	'format' => 'A4-L',
	'margin_left' => 0,
	'margin_right' => 0,
	'margin_top' => 0,
	'margin_bottom' => 0,
	'margin_header' => 0,
	'margin_footer' => 0
]);
$ow = $mpdf->h;
$oh = $mpdf->w;
$pw = $mpdf->w / 2;
$ph = $mpdf->h;
$mpdf->SetDisplayMode('fullpage');
$pagecount = $mpdf->SetSourceFile('1 enero 20 wo 1.pdf');
$pp = GetBookletPages($pagecount);
foreach($pp AS $v) {
	$mpdf->AddPage();
	if ($v[0]>0 && $v[0]<=$pagecount) {
		$tplIdx = $mpdf->ImportPage($v[0]);
		$mpdf->useTemplate($tplIdx, 0, 0, $pw, $ph);
	}
	if ($v[1]>0 && $v[1]<=$pagecount) {
		$tplIdx = $mpdf->ImportPage($v[1]);
		$mpdf->useTemplate($tplIdx, $pw, 0, $pw, $ph);
	}
}
$mpdf->Output();
unlink('test.pdf');
?>