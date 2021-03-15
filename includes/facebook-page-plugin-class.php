<?php
class facebook_page_plugin_widget extends WP_Widget{
    //construction
    public function __construct()
    {
        parent::__construct(
            'facebook_page_plugin_widget',//base id
            __('Facebook Page Plugin','fpp-domain'),//name
            array('description'=>__('Shows a facebook page plugin in a widget','fpp-domain'))
        );
    }

    //display widget
    public function widget($args,$instance){
        $data = array();

        $data['page_url'] = esc_attr($instance['page_url']);
        $data['adapt_container']    =   esc_attr($instance['adapt_container']);
        $data['width'] = esc_attr($instance['width']);
        $data['height'] = esc_attr($instance['height']);
        $data['show_timeline'] = esc_attr($instance['show_timeline']);
        $data['show_facepile'] = esc_attr($instance['show_facepile']);
        $data['small_header'] = esc_attr($instance['small_header']);
        $data['hide_cover'] =   esc_attr($instance['hide_cover']);

        echo $args['before_widget'];

        echo $args['before_title'];

        echo $instance['title'];

        echo $args['after_title'];

        //get main contents here
        echo $this->getPagePlugin($data);

        echo $args['after_widget'];


    }


    //backend for widget form
    public function form($instance){
        $this->getAdminForm($instance);
    }
    //front end widget form
    public function update($new_instance,$old_instance){
        // processes widget options to be saved
        $instance = array();

        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']):'';
        $instance['page_url'] = (!empty($new_instance['page_url'])) ? strip_tags($new_instance['page_url']):'';
        $instance['adapt_container'] = (!empty($new_instance['adapt_container'])) ? strip_tags($new_instance['adapt_container']):'';
        $instance['width'] = (!empty($new_instance['width'])) ? strip_tags($new_instance['width']):'';
        $instance['height'] = (!empty($new_instance['height'])) ? strip_tags($new_instance['height']):'';
        $instance['show_timeline'] = (!empty($new_instance['show_timeline'])) ? strip_tags($new_instance['show_timeline']):'';
        $instance['show_facepile'] = (!empty($new_instance['show_facepile'])) ? strip_tags($new_instance['show_facepile']):'';
        $instance['small_header'] = (!empty($new_instance['small_header'])) ? strip_tags($new_instance['small_header']):'';
        $instance['hide_cover'] = (!empty($new_instance['hide_cover'])) ? strip_tags($new_instance['hide_cover']):'';
        


        return $instance;
    }

    // build widget admin form
    // for $this->getAdminForm() a function with call same name . any name as your wish you can set.
    function getAdminForm($instance){
        //get title
        if(isset($instance['title'])){
            $title = $instance['title'];
        }else{
            $title = __('Like Us On facebook Thank you');
        }

        //get page url
        if(isset($instance['page_url'])){
            $page_url = $instance['page_url'];
        }else{
            $page_url = 'http://www.facebook.com/facebook';
        }

        // get adapt container
        if(isset($instance['adapt_container'])){
            $adapt_container = $instance['adapt_container'];
        }else{
            $adapt_container = 'true';
        }

        // get width 
        if (isset($instance['width'])) {
            $width = $instance['width'];
        }else{
            $width = 250;
        }

        // get height 
        if (isset($instance['height'])) {
            $height = $instance['height'];
        }else{
            $height = 250;
        }

        // get timeline 
        if (isset($instance['show_timeline'])) {
            $show_timeline = $instance['show_timeline'];
        }else{
            $show_timeline = 'true';
        }
        // get facepile  
        if (isset($instance['show_facepile'])) {
            $show_facepile = $instance['show_facepile'];
        }else{
            $show_facepile = 'true';
        }

        // get small header 
        if (isset($instance['small_header'])) {
            $small_header = $instance['small_header'];
        }else{
            $small_header = 'false';
        }

        // get hide cover 
        if (isset($instance['hide_cover'])) {
            $hide_cover = $instance['hide_cover'];
        }else{
            $hide_cover = 'false';
        }
       ?> 
       <!-- show title -->
       <p>
            <label for="<?php echo $this->get_field_id('title');?>"><?php _e('title');?></label>
            <input
                class="widefat"
                type="text"
                id="<?php echo $this->get_field_id('title');?>"
                name="<?php echo $this->get_field_name('title');?>"
                value="<?php echo esc_attr($title);?>"
            >
            
       </p>
        <!-- show page url -->
       <p>
            <label for="<?php echo $this->get_field_id('page_url');?>"><?php _e('Page URL');?></label>
            <input
                class="widefat"
                type="text"
                id="<?php echo $this->get_field_id('page_url');?>"
                name="<?php echo $this->get_field_name('page_url');?>"
                value="<?php echo esc_attr($page_url);?>"
            >
            
       </p>

        <!-- width -->
        <p>
            <label for="<?php echo $this->get_field_id('width');?>"><?php _e('Width');?></label>
            <input
                class="widefat"
                type="text"
                id="<?php echo $this->get_field_id('width');?>"
                name="<?php echo $this->get_field_name('width');?>"
                value="<?php echo esc_attr($width);?>"
            >
            
       </p>

        <!-- height -->
        <p>
            <label for="<?php echo $this->get_field_id('height');?>"><?php _e('Height');?></label>
            <input
                class="widefat"
                type="text"
                id="<?php echo $this->get_field_id('height');?>"
                name="<?php echo $this->get_field_name('height');?>"
                value="<?php echo esc_attr($height);?>"
            >
            
       </p>
       <!-- show time line: it is a select field -->

       <p>
            <label for="<?php echo $this->get_field_id('show_timeline');?>"><?php _e('Show Timeline');?></label>
            <select
                class="widefat"
                type="text"
                id="<?php echo $this->get_field_id('show_timeline');?>"
                name="<?php echo $this->get_field_name('show_timeline');?>"
                value="<?php echo esc_attr($show_timeline);?>"
            >
            <option value="true" <?php echo($show_timeline == 'true') ? 'selected': '';?>>true</option>
            <option value="false" <?php echo($show_timeline == 'false') ? 'selected': '';?>>false</option>
            </select>
       </p>

       <!-- adapt container -->

       <p>
            <label for="<?php echo $this->get_field_id('adapt_container');?>"><?php _e('Adapt Container');?></label>
            <select
                class="widefat"
                type="text"
                id="<?php echo $this->get_field_id('adapt_container');?>"
                name="<?php echo $this->get_field_name('adapt_container');?>"
                value="<?php echo esc_attr($adapt_container);?>"
            >
            <option value="true" <?php echo($adapt_container == 'true') ? 'selected': '';?>>true</option>
            <option value="false" <?php echo($adapt_container == 'false') ? 'selected': '';?>>false</option>
            </select>
       </p>

       <!-- show facepile -->

       <p>
            <label for="<?php echo $this->get_field_id('show_facepile');?>"><?php _e('Show Facepile');?></label>
            <select
                class="widefat"
                type="text"
                id="<?php echo $this->get_field_id('show_facepile');?>"
                name="<?php echo $this->get_field_name('show_facepile');?>"
                value="<?php echo esc_attr($show_facepile);?>"
            >
            <option value="true" <?php echo($show_facepile == 'true') ? 'selected': '';?>>true</option>
            <option value="false" <?php echo($show_facepile == 'false') ? 'selected': '';?>>false</option>
            </select>
       </p>

       <!-- show or not small header -->
       <p>
            <label for="<?php echo $this->get_field_id('small_header');?>"><?php _e('Small Header');?></label>
            <select
                class="widefat"
                type="text"
                id="<?php echo $this->get_field_id('small_header');?>"
                name="<?php echo $this->get_field_name('small_header');?>"
                value="<?php echo esc_attr($small_header);?>"
            >
            <option value="true" <?php echo($small_header == 'true') ? 'selected': '';?>>true</option>
            <option value="false" <?php echo($small_header == 'false') ? 'selected': '';?>>false</option>
            </select>
       </p>
        <!-- hide cover or not -->
        <p>
            <label for="<?php echo $this->get_field_id('hide_cover');?>"><?php _e('Hide Cover');?></label>
            <select
                class="widefat"
                type="text"
                id="<?php echo $this->get_field_id('hide_cover');?>"
                name="<?php echo $this->get_field_name('hide_cover');?>"
                value="<?php echo esc_attr($hide_cover);?>"
            >
            <option value="true" <?php echo($hide_cover == 'true') ? 'selected': '';?>>true</option>
            <option value="false" <?php echo($hide_cover == 'false') ? 'selected': '';?>>false</option>
            </select>
       </p>

        <?php

    }



// show in the frontend

    public function getPagePlugin($data){
       ?> 
    <div class="fb-page"
     data-href="<?php echo $data['page_url']; ?>"

     <?php if($data['show_timeline'] ==  'true'):?> 

     data-tabs="timeline"
    <?php else:?>
     data-tabs="event"
     <?php endif;?>

     <?php if($data['adapt_container'] == 'false'):?>
     data-width="<?php echo $data['width']; ?>" 
     data-height="<?php echo $data['height']; ?>" 
    <?php else:?>
     data-adapt-container-width="<?php echo $data['adapt_container']; ?>" 
    <?php endif;?>
     data-small-header="<?php echo $data['small_header']; ?>" 
     
     data-hide-cover=<?php echo $data['hide_cover']; ?>
     data-show-facepile="<?php echo $data['show_facepile']; ?>">
     <blockquote cite="<?php echo $data['page_url']; ?>" class="fb-xfbml-parse-ignore">
     <a href="<?php echo $data['page_url'];?>"></a></blockquote></div>

    <?php
    }
}
?>