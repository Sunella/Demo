<?php
/**
 * Video Plus Categories module
 *
 * This file is to display Categories module 
 *
 * @category   Apptha
 * @package    Mod_VideoPlusCategories
 * @version    2.1
 * @author     Apptha Team <developers@contus.in>
 * @copyright  Copyright (C) 2014 Apptha. All rights reserved.
 * @license    GNU General Public License http://www.gnu.org/copyleft/gpl.html
 */

// No direct access to this file
defined ( '_JEXEC' ) or die ( 'Restricted access' );
$ratearray = array (
		"nopos1",
		"onepos1",
		"twopos1",
		"threepos1",
		"fourpos1",
		"fivepos1" 
);

if (JRequest::getVar ( 'option' ) != 'com_contushdvideoshare') {
	$document = JFactory::getDocument ();
	$document->addStyleSheet ( JURI::base () . 'components/com_contushdvideoshare/css/mod_stylesheet.min.css' );
	$document->addScript ( JURI::base () . 'components/com_contushdvideoshare/js/jquery.js' );
	$document->addScript ( JURI::base () . "components/com_contushdvideoshare/js/htmltooltip.js" );
}

$dispenable = unserialize ( $result1 [0]->dispenable );
?>
<link rel="stylesheet"
	href="<?php echo JURI::base(); ?>components/com_contushdvideoshare/css/stylesheet.min.css"
	type="text/css" />
<?php
if ($catName > 0) {
	?>
<div id="categorymodule">
	<div id="module_videos" class="clearfix">
	<?php
	// For SEO settings
	$seoOption = $dispenable ['seo_option'];
	$strCategoryInc = 1;
	
	foreach ( $catName as $cat ) {
		$categoryName = $cat->id;
		$strVideoInc = 1;
		
		if ($strCategoryInc == 1 || $strCategoryInc % 4 == 1) {
			echo '<div class="clearfix" style="margin-bottom:10px;">';
		}
		?>
				<ul class="categories_video">
			<li>
		<?php
		$list = ModvideoplusCategoriesHelper::getVideocategories ($categoryName, $intVideoLimit);

		if (count ( $list ) > 0) {
			?>
							<h3><?php echo $cat->category; ?></h3>
				<ul>
							<?php
			foreach ( $list as $videoList ) {
				if ($videoList->playlistid == $categoryName) {
					if ($videoList->filepath == "File" || $videoList->filepath == "FFmpeg" || $videoList->filepath == "Embed") {
						$src_path = JURI::base () . "components/com_contushdvideoshare/videos/" . $videoList->thumburl;
					}
					
					if ($videoList->filepath == "Url" || $videoList->filepath == "Youtube") {
						$src_path = $videoList->thumburl;
					}
					
					$video_catid = (isset ( $videoList->playlistid )) ? $videoList->playlistid : '';
					
					if ($seoOption == 1) {
						$featureCategoryVal = "category=" . $videoList->seo_category;
						$featureVideoVal = "video=" . $videoList->seotitle;
					} else {
						$featureCategoryVal = "catid=" . $video_catid;
						$featureVideoVal = "id=" . $videoList->id;
					}
					?>
										<li>
						<div class="leftvideo">

										<?php
					if (isset ( $videoList->ratecount ) && $videoList->ratecount != 0) {
						$ratestar = round ( $videoList->rate / $videoList->ratecount );
					} else {
						$ratestar = 0;
					}
					?>
													<a class="info_hover" rel="htmltooltip"
								href="<?php
					echo JRoute::_ ( 'index.php?Itemid=' . $Itemid . '&amp;option=com_contushdvideoshare&view=player&' . $featureCategoryVal . '&' . $featureVideoVal, true );
					?>"> <img class="yt-uix-hovercard-target"
								src="<?php
					echo $src_path;
					?>" width="93"
								height="52" alt="" />
							</a>
															<?php
					if ($videoList->duration != null) {
						?>
													<div class="video_duration">
								<span><?php
						echo $videoList->duration;
						?></span>
							</div>
															<?php
					}
					?>

											</div>
						<div class="rightcontent">
							<h4>
								<a
									href="<?php
					echo JRoute::_ ( "index.php?Itemid=" . $Itemid . "&amp;option=com_contushdvideoshare&amp;view=player&amp;id=" . $videoList->id . "&amp;catid=" . $video_catid );
					?>"><?php
					if (strlen ( $videoList->title ) > 18) {
						echo (substr ( $videoList->title, 0, 33 )) . "...";
					} else {
						echo $videoList->title;
					}
					?></a>
							</h4>
												<?php
					if ($dispenable ['ratingscontrol'] == 1) {
						?>
													<div class=" clearfix">
														<?php
						if (isset ( $videoList->ratecount ) && $videoList->ratecount != 0) {
							$ratestar = round ( $videoList->rate / $videoList->ratecount );
						} else {
							$ratestar = 0;
						}
						?>
														<div class="floatleft innerrating">
									<div id="<?php
						echo $ratearray [$ratestar];
						?>"></div>
								</div>
							</div>
														<?php
					}
					?>

												<div class="clearfix"><?php
					if ($dispenable ['viewedconrtol'] == 1) {
						?>
														<div class="clsview"> <?php echo JText::_('HDVS_VIEWS') . ': '; ?></div>
								<span class="clsviewrate hit_rate"><?php
						echo $videoList->times_viewed;
						?>
														</span>
												<?php
					}
					?></div>
						</div>
						<div class="clear"></div>
					</li>

					<!--Tooltip Starts Here-->
					<div class="htmltooltip">
												<?php
					if ($videoList->description) {
						?>
													<p class="tooltip_discrip">
														<?php echo JHTML::_('string.truncate', (strip_tags($videoList->description)), 120); ?></p>
														<?php
					}
					?>
												<div class="tooltip_category_left">
							<span class="title_category"><?php echo JText::_('HDVS_CATEGORY'); ?>: </span>
							<span class="show_category"><?php echo $cat->category; ?></span>
						</div>
												<?php
					if ($dispenable ['viewedconrtol'] == 1) {
						?>
													<div class="tooltip_views_right">
							<span class="view_txt"><?php echo JText::_('HDVS_VIEWS'); ?>: </span>
							<span class="view_count"><?php echo $videoList->times_viewed; ?> </span>
						</div>
						<div id="htmltooltipwrapper37">
							<div class="chat-bubble-arrow-border"></div>
							<div class="chat-bubble-arrow"></div>
						</div>
												<?php
					}
					?>
											</div>

					<!--Tooltip end Here-->
					<?php
					if ($strVideoInc == $intVideoLimit) {
						break;
					}
					
					$strVideoInc ++;
				}
			}
			?>
							</ul>
		<?php
		}
		?>
						<div class="clsmorebtn clearfix">
					<a
						href="<?php
		echo JRoute::_ ( "index.php?Itemid=" . $Itemid . "&amp;option=com_contushdvideoshare&amp;view=category&amp;catid=" . $cat->id );
		?>"
						title="<?php
		echo JText::_ ( 'HDVS_MORE_VIDEOS' );
		?>"><?php
		echo JText::_ ( 'HDVS_MORE_VIDEOS' );
		?></a>
				</div>
			</li>
		</ul>
				<?php
		if ($strCategoryInc % 4 == 0 || $strCategoryInc == count ( $catName )) {
			echo '</div>';
		}
		?>
				<?php
		if ($strCategoryInc == $intCategoryLimit) {
			break;
		}
		
		$strCategoryInc ++;
	}
	?>
		</div>
</div>
<script type="text/javascript">
	jQuery.noConflict();
	jQuery(document).ready(function($) {
		jQuery(".ulvideo_thumb").mouseover(function() {
			htmltooltipCallback();
		});
	});
</script>
<?php
	$lang = JFactory::getLanguage ();
	$langDirection = ( bool ) $lang->isRTL ();
	
	if ($langDirection == 1) {
		$rtlLang = 1;
	} else {
		$rtlLang = 0;
	}
	?>
<!--Tooltip for video thumbs-->
<script type="text/javascript">
			jQuery.noConflict();
			window.onload = function()
			{
			htmltooltipCallback("htmltooltip", "",<?php echo $rtlLang; ?>);
			htmltooltipCallback("htmltooltip1", "1",<?php echo $rtlLang; ?>);
			htmltooltipCallback("htmltooltip2", "2",<?php echo $rtlLang; ?>);
			}

			jQuery(".ulvideo_thumb").mouseover(function() {
			htmltooltipCallback("htmltooltip", "",<?php echo $rtlLang; ?>);
			htmltooltipCallback("htmltooltip1", "1",<?php echo $rtlLang; ?>);
			htmltooltipCallback("htmltooltip2", "2",<?php echo $rtlLang; ?>);
			});
			jQuery(document).click(function() {
			htmltooltipCallback("htmltooltip", "",<?php echo $rtlLang; ?>);
			htmltooltipCallback("htmltooltip1", "1",<?php echo $rtlLang; ?>);
			htmltooltipCallback("htmltooltip2", "2",<?php echo $rtlLang; ?>);
			});


			</script>
<?php
}
