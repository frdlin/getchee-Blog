<!-- Footer -->
          <aside id="sub-footer">
               <div id="footer-left">
                    <div id="left-group">
                         <blockquote id="footer-quote">
                              <p><q>Everywhere is walking distance if you have the time.</q></p>
                              <footer><p><em>- Steven Wright</em></p></footer>
                         </blockquote>
                         <div id="under-quote">
                              <p>Unfortunately, brand owners operating in Asia have little time for leisurely exploration. Now is the time for better, smarter planning and execution for emerging markets.</p>
                              <hr/>
                         </div>
                         <section>
                              <h2 class="half">Our Website</h2>
                              <div id="internal-link">
                                   <dl>
                                        <dd>Visit the <a href="http://www.getchee.com/" target="_blank">getchee website</a> for more information about data, services, and solutions for markets in Asia.</dd>
                                   </dl>
                              </div>
                         </section>
                         <div id="social-network-block">
                              <nav>
                                   <ul class="social-network">
                                        <li><a href="http://www.linkedin.com/groups/getchee-2343208?mostPopular=&amp;gid=2343208" target="_blank" title="LinkedIn"><img src="<?php echo IMAGES . '/nav-social-network-linkedin.png'; ?>" class="ro" alt="LinkedIn"></a></li>
                                        <li><a href="http://www.facebook.com/teamgetchee" target="_blank" title="Facebook"><img src="<?php echo IMAGES . '/nav-social-network-facebook.png'; ?>" class="ro" alt="Facebook"></a></li>
                                        <li><a href="http://twitter.com/getchee" target="_blank" title="Twitter"><img src="<?php echo IMAGES . '/nav-social-network-twitter.png'; ?>" class="ro" alt="Twitter"></a></li>
                                   </ul>
                              </nav>
                         </div>
                    </div>
               </div>
               <div id="footer-right">
                    <div id="right-group">
                         <h1>We provide market insight, tools, and services to help brands thrive in Asia. <a href="http://www.getchee.com/about/our-company.html" title="Learn More" target="_blank" >Learn More</a>.</h1>
                         <div id="footer-form">
                              <h2>Curious? Get in touch.</h2>
                              <form action="../../../s2form/process.php" method="post" accept-charset="utf-8" id="contact-form" name="form" onSubmit="return checkFields()" autocomplete="off">
                                   <input name="name" id="name" class="validate[required] yourname star" type="text" placeholder="Name">
                                   <input name="email" id="email" class="validate[required,custom[email]] youremail star" type="email" placeholder="Email">
                                   <textarea name="message" id="message" class="validate[required] textarea star" placeholder="Question"></textarea>
                                   <div id="qna">
                                        <label for="captcha" id="captcha_question"></label>
                                        <input type="text" name="" value="" id="captcha">
                                        <p id="captcha_error">Captcha test failed. Please try again.</p>
                                        <script src="../s2form/captcha.js" ></script>
                                   </div>
                                   <input type="hidden" name="tags" value="Leads from Blog">
                                   <div class="left_f" >
                                   <input type="checkbox" class="styled" name="newsletter subscription" value="Yes" checked="checked"/>
                                   <span class="checkbox_label">Signup for our newsletter.</span>
                                        <ul class="newsletter_link gallery clearfix">
                                             <li class="preview"><a href="http://www.getchee.com/images/newsletter-preview.png" rel="prettyPhoto" title="">Preview</a></li>
                                             <li class="archive"><a href="http://www.getchee.com/newsletter/index.html" target="_blank" >Archive</a></li>
                                        </ul>
                                   </div>
                                   <div class="right_f">
                                        <input type="submit" class="button dark" name="subbut" value="Send" id="btnSignUp"/>
                                   </div>
                              </form>
                         </div>
                    </div>
               </div>
               <div class="clear"></div>
               <script>
               $(document).ready(function(){
                    $("area[rel^='prettyPhoto']").prettyPhoto();
                    
                    $(".gallery:first a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'normal',theme:'light_square',slideshow:3000, autoplay_slideshow: true});
                    $(".gallery:gt(0) a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'fast',slideshow:10000, hideflash: true});
          
                    $("#custom_content a[rel^='prettyPhoto']:first").prettyPhoto({
                         custom_markup: '<div id="map_canvas" style="width:260px; height:265px"></div>',
                         changepicturecallback: function(){ initialize(); }
                    });

                    $("#custom_content a[rel^='prettyPhoto']:last").prettyPhoto({
                         custom_markup: '<div id="bsap_1259344" class="bsarocks bsap_d49a0984d0f377271ccbf01a33f2b6d6"></div><div id="bsap_1237859" class="bsarocks bsap_d49a0984d0f377271ccbf01a33f2b6d6" style="height:260px"></div><div id="bsap_1251710" class="bsarocks bsap_d49a0984d0f377271ccbf01a33f2b6d6"></div>',
                         changepicturecallback: function(){ _bsap.exec(); }
                    });
               });
               </script>
          </aside>
          
          <footer id="main-footer">
               <div class="wrapper">
                    <nav id="footer_nav">
                         <ul>
                              <li><a href="http://www.getchee.com/privacy-policy.html" target="_blank" title="Privacy Policy">Privacy Policy</a></li>
                              <li class="last"><a href="http://www.getchee.com/terms-of-use.html" target="_blank" title="Terms of Use">Terms of Use</a></li>
                         </ul>
                    </nav>
                    <small>&copy; <script>document.write((new Date()).getFullYear());</script> getchee. All rights reserved.</small>
               </div>
          </footer>
     <!-- Footer -->
</body>
</html>