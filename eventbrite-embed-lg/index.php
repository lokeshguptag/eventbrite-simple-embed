<?php
/**
 * Plugin Name: Eventbrite Embed Plugin
 * Plugin URI: https://www.lokeshgupta.in
 * Description: Display content using a shortcode to insert in a page or post
 * Version: 0.1
 * Text Domain: lg-eventbrite-wordpress-plugin
 * Author: Lokesh Gupta
 * Author URI: https://www.lokeshgupta.in
 */
  
function eventbrite_embed_code($atts) {
	$default = array(
        'label' => 'Buy Ticket',
        'event-id' => ''
    );
    $params = shortcode_atts($default, $atts);
	ob_start();
	?>
	<!-- Noscript content for added SEO -->
	<noscript><a class="wp-block-button__link wp-element-button" href="https://www.eventbrite.com/e/test-by-selectiva-tickets-<?php echo $params['event-id'];?>" rel="noopener noreferrer" target="_blank"><?php echo $params['label'];?></a></noscript>
	<!-- You can customize this button any way you like -->
	<button class="wp-block-button__link wp-element-button" id="eventbrite-widget-modal-trigger-<?php echo $params['event-id'];?>" type="button"><?php echo $params['label'];?></button>

	<script src="https://www.eventbrite.com/static/widgets/eb_widgets.js"></script>

	<script type="text/javascript">
	    var exampleCallback = function() {
	        console.log('Order complete!');
	    };

	    window.EBWidgets.createWidget({
	        widgetType: 'checkout',
	        eventId: '<?php echo $params['event-id'];?>',
	        modal: true,
	        modalTriggerElementId: 'eventbrite-widget-modal-trigger-<?php echo $params['event-id'];?>',
	        onOrderComplete: exampleCallback
	    });
	</script>	
	<?php
	$output = ob_get_contents();
	ob_end_clean(); 
    return $output;
}
add_shortcode('eventbrite-embed-code', 'eventbrite_embed_code');