<?php
/**
 * The template for displaying all recipe pages
 *
 * This is the template that displays all recipe pages by default.
 *
 */
get_header(); ?>
<div class="container clearfix">
	<div class="bodypaninner clearfix">
    	<div class="wp-easy-recipe-details wp-easy-recipe">
		<div class="<?php echo (is_active_sidebar( 'wp-easy-recipe-sidebar-1' ) ? 'leftpan' : 'recipy-full-width')?>">			
    <?php 
    while ( have_posts() ) : the_post(); 
                 
    $recipetagsAry=wp_get_post_tags(get_the_ID());
	$reciepTags='';
	if(is_array($recipetagsAry) && count($recipetagsAry) > 0)
	{
	foreach($recipetagsAry as $recipetagsVal)
	{
		$reciepTags.='<a href="' . esc_attr(get_term_link($recipetagsVal->term_id, $recipetagsVal->taxonomy)) . '" title="' . sprintf( __( "View all recipe in %s" ), $recipetagsVal->name ) . '" ' . '>' . $recipetagsVal->name.'</a>, ';
		
		}
	}
		
	$recipecategoryAry=get_the_terms(get_the_ID(),'wp_easy_recipe_tax');
	$recipeCat='';
	$quicklinks_cuisine=array();$quicklinks_course=array();
	$ij=0;$jk=0;
	if(is_array($recipecategoryAry) && count($recipecategoryAry) > 0)
	{
	foreach($recipecategoryAry as $recipecategoryVal)
	{
		//define quick links for cuisine category
		//if($recipecategoryVal->parent=='32'){
		if($recipecategoryVal->parent='32'){	
		$quicklinks_cuisine[$ij]['name']=$recipecategoryVal->name;
		$quicklinks_cuisine[$ij]['url']=esc_url(get_term_link($recipecategoryVal->term_id, $recipecategoryVal->taxonomy));
		$ij++;
		}
		
		//define quick links for course category
		if($recipecategoryVal->parent=='33'){
		$quicklinks_course[$jk]['name']=$recipecategoryVal->name;
		$quicklinks_course[$jk]['url']=esc_url(get_term_link($recipecategoryVal->term_id, $recipecategoryVal->taxonomy));
		$jk++;
		}
		
		
		$recipeCat.='<a href="' . esc_url(get_term_link($recipecategoryVal->term_id, $recipecategoryVal->taxonomy)) . '" title="' . sprintf( __( "View all recipe in %s" ), $recipecategoryVal->name ) . '" ' . '>' . $recipecategoryVal->name.'</a>, ';
		}
	}
		$aurhorImg1 =get_avatar( get_the_author_meta( 'user_email' ));
		
		$aurhorFullImg1 =get_avatar( get_the_author_meta( 'user_email' ));
		
		$authorDesc =get_the_author_meta('description');
		
		if($aurhorImg1!=''){
		$aurhorImg='<a href="'.esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ).'">'.$aurhorImg1.'</a>';$aurhorFullImg='<a href="'.esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ).'">'.$aurhorFullImg1.'</a>';}
						
		$authorName =get_the_author();

	    $cuisine=''; 
	    $course='';
	    if(count($quicklinks_cuisine)!=0)
	    {
			$cunt=count($quicklinks_cuisine);
			$jk=1;
			foreach ($quicklinks_cuisine as $quicklinks_cuisineval)
			{
				$cuisine.='<a href="'.$quicklinks_cuisineval['url'].'" alt="'.$quicklinks_cuisineval['name'].'">'.$quicklinks_cuisineval['name'].'</a>';
				
				if($jk==$cunt){$cuisine.='';}else{$cuisine.=', ';}
				
				$jk++;
				}
			}
			
	    if(count($quicklinks_course)!=0)
	    {
			$cunt=count($quicklinks_course);
			$jk=1;
			foreach ($quicklinks_course as $quicklinks_courseval)
			{
				$course.='<a href="'.$quicklinks_courseeval['url'].'" alt="'.$quicklinks_courseval['name'].'">'.$quicklinks_courseval['name'].'</a>';
				if($jk==$cunt){$cuisine.='';}else{$cuisine.=', ';}
				}
			
			}
			else 
			{ 
				$course='';
				}
                 ?>
                <div class="row">
                    	<?php //feature images
                    	the_post_thumbnail('full');
                    	?>
                    
                
      
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			
                <div class="row">                
                        <div class="recipe_left">
                    	<div class="box_first">
                        	<h4>Quick Look</h4>
                            <ul class="quick_look_list">
                            	 <li><span>Main Ingredients</span><?php echo get_post_meta(get_the_ID(),'wp_er_main-ingredients',true);?></li>
                                <li><span>Cuisine</span><?php echo get_post_meta(get_the_ID(),'wp_er_cuisine',true);?></li>
                                <li><span>Course</span><?php echo get_post_meta(get_the_ID(),'wp_er_course',true);?></li>
                                <li><span>Level Of Cooking</span><?php echo get_post_meta(get_the_ID(),'wp_er_lavel-of-cooking',true);?></li>
                            </ul>
                            
                        </div>
                        
                        <div class="box_second">
                        	<h4>Nutrition Facts</h4>
                        	
                            <ul class="quick_look_list">
							<?php 
                        	$NutritionFactsAry =explode(',',get_post_meta(get_the_ID(),'wp_er_nutrition-facts',true));
                        	foreach ($NutritionFactsAry as $Nutritionvalue):
                        	echo '<li><span>'.$Nutritionvalue.'</span></li>';
                        	endforeach;
                        	?>
                            
                            </ul>
                            
                        </div>
                    </div>
                        
                        <div class="recipe_right">
                            <h1><?php the_title(); ?></h1>
                            
                               <div class="rating_wp clearfix">
                                            <div class="rating">
                                               <img src="<?php echo  plugins_url( 'lib/images/rate.jpg' , __FILE__ );?>" alt="">
                                            </div>
                                            <div class="admin_name">
                                       	  <div class="admin_pro"><img src="<?php echo  plugins_url( 'lib/images/admin_pro.jpg' , __FILE__ );?>" alt=""></div>
                                            <div class="admin_pro_name"><a href=":javascript:"><?php echo $authorName; ?></a></div>
                                      </div>
                                        </div>
                                        
                             
                            <div class="row_line">
                            <!-- <div class="one-half">-->
                               <ul class="cook_cate">
                                    <li><i class="prepairation_time"></i> <strong>Prepairation Time: </strong><?php echo get_post_meta(get_the_ID(),'wp_er_prepairation-time',true);?></li>
                                    <li><i class="cooking_time"></i> <strong>Cooking Time: </strong><?php echo get_post_meta(get_the_ID(),'wp_er_cooking-time',true);?></li>
                                    <li><i class="servings"></i> <strong>Servings: </strong><?php echo get_post_meta(get_the_ID(),'wp_er_servings',true);?></li>
                                    <li><i class="category"></i> <strong>Category: </strong> <?php echo get_post_meta(get_the_ID(),'wp_er_category',true);?></li>
                               </ul>
                           <!--  </div>-->
                              
                                
                                <?php 
                                
                                if(function_exists('get_wp_easy_recipe_options'))
                                {
									$werOptions =get_wp_easy_recipe_options();
									
									
									 if(isset($werOptions['wpe_shareBtns']) && $werOptions['wpe_shareBtns']!=''){
										 echo '<div class="one-half last">';
										 echo $werOptions['wpe_shareBtns'];
										 echo ' </div>';
										 }else 
									{
										echo '';
										
										}
									}
                                ?>
                                
                            
                           </div>
                           
                          <div class="recipe-content">  
                          <?php the_content();?>
                             </div> 
                         
                          <div class="row_line">
                                <ul class="cook_tag">
                                            <?php if($recipeCat!=''){?>
                                            <li class="list_drop">
                                               <?php echo $recipeCat;?>
                                            </li>
                                            <?php }
                                            if($reciepTags!=''){
                                            ?>
                                            <li class="list_drop1">
                                                <?php echo $reciepTags;?>
                                            </li>
                                            <?php }?>
                                   </ul>
                             </div>
                         <?php if($authorDesc!=''):?>
                             <div class="cook_profile">
                                <?php echo $aurhorFullImg; ?>
                                <h2><?php echo $authorName; ?></h2>
                                <p><?php echo $authorDesc; ?></p>
                                
                             </div>
                             <?php endif;?>
                             
                        </div>
                    </div>
                
                
           <?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', '' ), 'after' => '</div>' ) ); ?>
				<footer class="entry-meta">
					<?php edit_post_link( __( 'Edit', '' ), '<span class="edit-link">', '</span>' ); ?>
				</footer><!-- .entry-meta -->
          
               </div><!-- .entry-content --><!-- #post -->
		
		  <?php endwhile; ?>
        
             </div>        

			</div>

		</div>

        <?php 
       if ( is_active_sidebar( 'wp-easy-recipe-sidebar-1' ) ) : ?>
       <div class="rightpan">
       <?php dynamic_sidebar( 'wp-easy-recipe-sidebar-1' ); ?>
       </div>
       <?php endif;?>
	</div>
</div>
<?php get_footer(); ?>
