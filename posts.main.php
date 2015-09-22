<?php
/**
 * This is the main/default page template for the "postlog" skin.
 *
 * This skin only uses one single template which includes most of its features.
 * It will also rely on default includes for specific dispays (like the comment form).
 *
 * For a quick explanation of b2evo 2.0 skins, please start here:
 * {@link http://manual.b2evolution.net/Skins_2.0}
 *
 * The main page template is used to display the blog when no specific page template is available
 * to handle the request (based on $disp).
 *
 * @package evoskins
 * @subpackage postlog
 *
 * @version $Id: index.main.php,v 1.16 2008/04/15 21:53:31 fplanque Exp $
 */
if( !defined('EVO_MAIN_INIT') ) die( 'Please, do not access this page directly.' );

if( version_compare( $app_version, '2.4.1' ) < 0 )
{ // Older 2.x skins work on newer 2.x b2evo versions, but newer 2.x skins may not work on older 2.x b2evo versions.
	die( 'This skin is designed for b2evolution 2.4.1 and above. Please <a href="http://b2evolution.net/downloads/index.html">upgrade your b2evolution</a>.' );
}

// This is the main template; it may be used to display very different things.
// Do inits depending on current $disp:
skin_init( $disp );


// -------------------------- HTML HEADER INCLUDED HERE --------------------------
skin_include( '_html_header.inc.php' );
// Note: You can customize the default HTML header by copying the generic
// /skins/_html_header.inc.php file into the current skin folder.
// -------------------------------- END OF HEADER --------------------------------
?>

<!-- WHOLE PAGE start  -->
<div id="wrapper">

<?php
// -------------------------- HTML HEADER INCLUDED HERE --------------------------
skin_include( '_body_header.inc.php' );
// Note: You can customize the default HTML header by copying the generic
// /skins/_html_header.inc.php file into the current skin folder.
// -------------------------------- END OF HEADER --------------------------------
?>
<!-- WHOLE MAIN start  -->
  <div id="innerwrapper">
  <!-- WHOLE MAIN END  -->


<!-- =================================== START OF MAIN AREA =================================== -->



<!-- SIDEBAR start  -->
<?php
// -------------------------- HTML HEADER INCLUDED HERE --------------------------
skin_include( '_sidebar.inc.php' );
// Note: You can customize the default HTML header by copying the generic
// /skins/_html_header.inc.php file into the current skin folder.
// -------------------------------- END OF HEADER --------------------------------
?><!-- SIDEBAR END  -->


<div id="tqset">

	<?php
		// ------------------------- MESSAGES GENERATED FROM ACTIONS -------------------------
		messages( array(
				'block_start' => '<div class="action_messages">',
				'block_end'   => '</div>',
			) );
		// --------------------------------- END OF MESSAGES ---------------------------------
	?>

            
 
	<?php
		// --------------------------------- START OF POSTS -------------------------------------
		// Display message if no post:
		display_if_empty();

		while( $Item = & mainlist_get_item() )
		{	// For each blog post, do everything below up to the closing curly brace "}"
		?>




<div id="tq<?php $Item->anchor_id() ?>" class="pozt catID<?php echo $Item->main_cat_ID ?>">
		<div class="status<?php $Item->status_raw() ?> " lang="<?php $Item->lang() ?>">

			<div class="editlinkwrapper"><span class="peditl">		<?php $Item->edit_link( array( // Link to backoffice for editing
							'before'    => '',
							'after'     => '',
						) );?></span></div>
			<?php
				$Item->locale_temp_switch(); // Temporarily switch to post locale (useful for multilingual blogs)
			?>




			<h2 class="ptitle"><?php $Item->title(); ?></h2>

			<?php
				// ---------------------- POST CONTENT INCLUDED HERE ----------------------
				skin_include( '_item_content.inc.php', array(
						'image_size'	=>	'fit-800x640',
					) );
				// Note: You can customize the default item feedback by copying the generic
				// /skins/_item_feedback.inc.php file into the current skin folder.
				// -------------------------- END OF POST CONTENT -------------------------
			?>
<div class="pozt_details">
			<?php
				// List all tags attached to this post:
				$Item->tags( array(
						'before' =>         '<div class="bSmallPrint tags">'.T_('Tags').': ',
						'after' =>          '</div>',
						'separator' =>      ', ',
					) );
			?>
            
            <span class="author"><?php
				$Item->author( array(
						'before'    => '',
						'after'     => '',
					) );

				$Item->msgform_link();
				echo ', ';?></span>
	<span class="time">		<?php
				// Permalink:
				$Item->permanent_link( array(
						'text' => '#icon#',
					) );

				$Item->issue_time( array(
						'before'    => ' ',
						'after'     => '',
						'time_format' => 'M j / H:i',
					));

			?></span>

			<br />

			<?php
				$Item->categories( array(
					'before'          => T_('Categories').': ',
					'after'           => ' ',
					'include_main'    => true,
					'include_other'   => false,
					'include_external'=> false,
					'link_categories' => true,
				) );
			?>
			<div class="bSmallPrint">
				<?php
					// Permalink:
					$Item->permanent_link( array(
							'class' => 'permalink_right',
						) );

					// Link to comments, trackbacks, etc.:
					$Item->feedback_link( array(
									'type' => 'comments',
									'link_before' => '',
									'link_after' => '',
									'link_text_zero' => '#',
									'link_text_one' => '#',
									'link_text_more' => '#',
									'link_title' => '#',
									'use_popup' => false,
								) );

					// Link to comments, trackbacks, etc.:
					$Item->feedback_link( array(
									'type' => 'trackbacks',
									'link_before' => ' &bull; ',
									'link_after' => '',
									'link_text_zero' => '#',
									'link_text_one' => '#',
									'link_text_more' => '#',
									'link_title' => '#',
									'use_popup' => false,
								) );

				?>
			</div><!-- end of bSmallPrint-->
         </div><!-- end of pozt_details-->

			<?php
				// ------------------ FEEDBACK (COMMENTS/TRACKBACKS) INCLUDED HERE ------------------
				skin_include( '_item_feedback.inc.php', array(
						'before_section_title' => '<h4>',
						'after_section_title'  => '</h4>',
					) );
				// Note: You can customize the default item feedback by copying the generic
				// /skins/_item_feedback.inc.php file into the current skin folder.
				// ---------------------- END OF FEEDBACK (COMMENTS/TRACKBACKS) ---------------------
		?>
			<?php
				locale_restore_previous();	// Restore previous locale (Blog locale)
			?>
	</div><!-- end of #item_ID-->
</div><!-- end of .pozt cat-->
		<?php
		} // ---------------------------------- END OF POSTS ------------------------------------
	?>

</div><!-- end of .content -->
	<?php
		// -------------------- PREV/NEXT PAGE LINKS (POST LIST MODE) --------------------
		mainlist_page_links( array(
				'block_start' => '<div id="tqitempn" class="pagenumbers"><strong>',
				'block_end' => '</strong></div>',
   			'prev_text' => '&lt;&lt;Previous&nbsp;Page<br/>',
   			'next_text' => '<br/>Next&nbsp;Page&gt;&gt;',
			) );
		// ------------------------- END OF PREV/NEXT PAGE LINKS -------------------------
	?>


	<?php
		// -------------- MAIN CONTENT TEMPLATE INCLUDED HERE (Based on $disp) --------------
		skin_include( '$disp$', array(
				'disp_posts'  => '',		// We already handled this case above
				'disp_single' => '',		// We already handled this case above
				'disp_page'   => '',		// We already handled this case above
			) );
		// Note: you can customize any of the sub templates included here by
		// copying the matching php file into your skin directory.
		// ------------------------- END OF MAIN CONTENT TEMPLATE ---------------------------
	?>



<!-- =================================== START OF FOOTER =================================== -->

</div><!-- end of #innerwrapper -->

</div><!-- end of #wrapper-->

	<script type="text/javascript">	jQuery("#tqset .pozt").draggable({ stack: { group: '#tqset .pozt', min: 120 } });
;</script>
    
 

<?php
// -------------------------- HTML HEADER INCLUDED HERE --------------------------
skin_include( '_body_footer.inc.php' );
// Note: You can customize the default HTML header by copying the generic
// /skins/_html_header.inc.php file into the current skin folder.
// -------------------------------- END OF HEADER --------------------------------
?>
<?php
// ------------------------- HTML FOOTER INCLUDED HERE --------------------------
skin_include( '_html_footer.inc.php' );
// Note: You can customize the default HTML footer by copying the
// _html_footer.inc.php file into the current skin folder.
// ------------------------------- END OF FOOTER --------------------------------
?>