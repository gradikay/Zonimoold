    <div id="ads" class="container-fluid">
        <div class="row">
            <div class="col-lg-12">                          
                <?php //Session data Start
                    if($this->session->userdata('username')) : ?>    
                    <h4>
                    Publish your ad<br>
                    </h4>                     
                <?php //Session data end
                    endif; ?>
                <?php if($this->session->flashdata('success_post')) : ?>
                            <div class="alert alert-success">
                                <?php echo $this->session->flashdata('success_post'); ?>
                            </div>
                        <?php endif;  ?>

                        <?php if($this->session->flashdata('failed_post')) : ?>
                            <div class="alert alert-danger">
                                <?php echo $this->session->flashdata('failed_post') ; ?>
                            </div>
                        <?php endif;  ?>
                        <?php if($this->session->flashdata('error')) : ?>
                            <div class="alert alert-warning">
                                <?php echo $this->session->flashdata('error') ; ?>
                            </div>
                        <?php endif;  ?>
                        <?php if($this->session->flashdata('delete_ad')) : ?>
                            <div class="alert alert-warning">
                                <?php echo $this->session->flashdata('delete_ad') ; ?>
                            </div>
                        <?php endif;  ?>
            </div>
            <div role="tabpanel">

              <!-- Nav tabs -->
              <ul class="nav nav-tabs" role="tablist">
                  
                <li role="presentation" class="active"><a href="#upload" aria-controls="upload" role="tab" data-toggle="tab">Upload ad</a></li>
                <li role="presentation"><a href="#published" aria-controls="published" role="tab" data-toggle="tab">My bublished ad <span class="badge"><?php echo $allads;?></span></a></li>
                
              </ul>

              <!-- Tab panes -->
              <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="upload">
                    <?php echo form_open_multipart('user/upload_ad');?>
            <div class="col-lg-6" style="padding-top:20px;">                         
                <div id="imagePost"><img id="imageWindow" src=""></div>
                <div class="form-group">
                    <label>Post Image &#42;</label>
                    <input type="file" id="uploadInput" class="form-control space" name="post_image" required>
                </div>
            </div>
            <div class="col-lg-6" style="padding-top:20px;">
                <table class="table table-striped">
                    <tr>
                        <td>Company name &#42;</td>
                        <td colspan="3">
                            <input type="text" class="form-control" placeholder="At&t" name="company_name">                            
                        </td>
                    </tr>
                    <tr>
                        <td >Gender &#42;</td>
                        <td colspan="2">
                            <select class="selectpicker" name="target_gender">
                                <option value=" " selected="selected" disabled="disabled">Choose gender ...</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="male and female">both</option>
                           </select>                            
                        </td>
                    </tr>
                    <tr>
                        <td>Age &#42;</td>
                        <td>From
                            <select class="selectpicker" name="target_age_from" required>
                        <option value=" " selected="selected" disabled="disabled">age ...</option>
                        <option value="all">all</option> 
                        <option value="13">13</option> <option value="14">14</option>
                        <option value="15">15</option> <option value="16">16</option>
                        <option value="17">17</option> <option value="18">18</option>
                        <option value="19">19</option> <option value="20">20</option>
                        <option value="21">21</option> <option value="22">22</option>
                        <option value="23">23</option> <option value="24">24</option>
                        <option value="25">25</option> <option value="26">26</option>
                        <option value="27">27</option> <option value="28">28</option>
                        <option value="29">29</option> <option value="30">30</option>
                        <option value="31">31</option> <option value="32">32</option>
                        <option value="33">33</option> <option value="34">34</option>
                        <option value="35">35</option> <option value="36">36</option>
                        <option value="37">37</option> <option value="38">38</option>
                        <option value="39">39</option> <option value="40">40</option>
                        <option value="41">41</option> <option value="42">42</option>
                        <option value="43">43</option> <option value="44">44</option>
                        <option value="45">45</option> <option value="46">46</option>
                        <option value="47">47</option> <option value="48">48</option>
                        <option value="49">49</option> <option value="50">50</option>
                        <option value="60 and up">60 +</option> 
                   </select>                            
                        </td>
                        <td>To 
                            <select class="selectpicker" name="target_age_to" required>
                        <option value=" " selected="selected" disabled="disabled">age ...</option>
                        <option value="all">all</option> 
                        <option value="13">13</option> <option value="14">14</option>
                        <option value="15">15</option> <option value="16">16</option>
                        <option value="17">17</option> <option value="18">18</option>
                        <option value="19">19</option> <option value="20">20</option>
                        <option value="21">21</option> <option value="22">22</option>
                        <option value="23">23</option> <option value="24">24</option>
                        <option value="25">25</option> <option value="26">26</option>
                        <option value="27">27</option> <option value="28">28</option>
                        <option value="29">29</option> <option value="30">30</option>
                        <option value="31">31</option> <option value="32">32</option>
                        <option value="33">33</option> <option value="34">34</option>
                        <option value="35">35</option> <option value="36">36</option>
                        <option value="37">37</option> <option value="38">38</option>
                        <option value="39">39</option> <option value="40">40</option>
                        <option value="41">41</option> <option value="42">42</option>
                        <option value="43">43</option> <option value="44">44</option>
                        <option value="45">45</option> <option value="46">46</option>
                        <option value="47">47</option> <option value="48">48</option>
                        <option value="49">49</option> <option value="50">50</option>
                        <option value="60 and up">60 +</option> 
                   </select>                            
                        </td>
                    </tr>
                    <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                    <tr>
                        <input type="hidden" name="cmd" value="_s-xclick">
                        <input type="hidden" name="hosted_button_id" value="ZDS47WYPRTSMC">
                        
                            <td>Plan &#42;
                                <input type="hidden" name="on0" value="">
                            </td>
                            <td colspan="2">
                                <select class="selectpicker" name="os0" required>
                                    <option value=" " selected="selected" disabled="disabled">Plan ...</option>    
                                    <option value="runs for 3 days">runs for 3 days : $2.00 USD - daily</option>
                                    <option value="runs for 10 days">runs for 10 days : $5.00 USD - weekly</option>
                                    <option value="runs for 17 days">runs for 17 days : $9.00 USD - weekly</option>
                                    <option value="runs for a month">runs for a month : $20.00 USD - monthly</option>
                                </select>
                       
                        <input type="hidden" name="currency_code" value="USD">
                        <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_subscribeCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                        <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                        </td>
                    </tr>
                    </form>
                    <tr>
                        <td>Your catchy word goes here &#42;</td>
                        <td colspan="2">
                            <textarea class="form-control" cols="50" maxlength="95" name="catchy_word" required>
                            </textarea>                            
                        </td>
                    </tr>
                    <tr>
                        <td>Shortly describe your ad in 95 words &#42;</td>
                        <td colspan="2">
                            <textarea class="form-control" cols="50" maxlength="95" name="description" required>
                            </textarea>                            
                        </td>
                    </tr>
                    <tr>
                        <td>URL &#42;</td>
                        <td colspan="3">
                            <input type="url" class="form-control" placeholder="https:// ....com" name="url" required>                            
                        </td>
                    </tr>
                    <tr>
                        <td>Call to action <small>(Optional)</small></td>
                        <td colspan="3">
                            <select class="selectpicker" name="call_to_action">
                                <option value=" " selected="selected" disabled="disabled">Action ...</option>
                                <option value="sign up">Sign Up</option>
                                <option value="book now">Book Now</option>
                                <option value="learn more">Learn More</option>
                                <option value="download">Download</option>
                                <option value="shop now">Shop Now</option>
                           </select>                
                        </td>
                    </tr>
                    <tr><td colspan="3">
                        <input class="btn btn-primary" type="submit" value="Publish my ad now !">
                    </td></tr>    
                </table>                
                
            </div>
            </form>
                </div>
                <div role="tabpanel" class="tab-pane" id="published">
                    <div class="row" style="padding:20px;">
                    <?php $x = 1;?>    
                    <?php foreach($myads as $ad):?>
                    
                      <div class="col-sm-6 col-md-4">
                        <div class="thumbnail"><a href="<?php echo $ad->url;?>" target="_blank">
                          <img src="<?php echo base_url();?>/adsimages/<?php echo $ad->orig_name;?>"></a>
                          <div class="caption">
                            <h3><?php echo $ad->company_name;?></h3>
                            <p><?php echo $ad->catchy_word;?></p>
                            <p><?php echo $ad->description;?></p>
                            <p><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#admodel<?php echo $x;?>" name="ad<?php echo $x;?>">Delete ad</button>
                                <a href="<?php echo $ad->url;?>" class="btn btn-warning" role="button"><?php echo $ad->call_to_action;?></a></p>
                          </div>
                        </div>
                      </div>                  

                        <form method="post" action="<?php echo base_url(); ?>user/delete_ad">
                        <input type="hidden" name="id" value="<?php echo $ad->id; ?>">
                        <div class="modal fade" id="admodel<?php echo $x;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Delete Ad</h4>
                              </div>
                              <div class="modal-body">
                                <h3>You are about to delete this ad ! Are you sure?</h3>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <input class="btn btn-danger" type="submit" value="Delete">
                              </div>
                            </div>
                          </div>
                        </div>
                        </form>    
                        <?php $x++?>
                    <?php endforeach;?>
                    </div>
                </div>
              </div>

            </div>
            
        </div>
    </div>
    <!-- /#page-content-wrapper -->

</div>
<!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();            
            reader.onload = function (e) {
                $('#imageWindow').attr('src', e.target.result);
            }            
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#uploadInput").change(function(){
        readURL(this);
    });
</script>

</body>

</html>
