<div class="row">
  
        <div class="col-sm-6" style="width: 100%;">
            <div class="appoin_txt">EXERCISE INFORMATION</div>
            <div class="datehead">
                <?php echo $exer_info[0]['title']; ?>
            </div>
            <div class="descriptiohead"> <span>DESCRIPTION</span> </div>
            <div class="descriptiotxt">
               <?php echo $exer_info[0]['description']; ?>
              
                
            </div>
            <div class="descriptiohead"><span>PICTURES</span>
                <?php
                $media_image = 'https://exorlive.com/media_'.$exer_info[0]['image_id'].'@80.80.media';
                $media_video = 'https://exorlive.com/video/?ex='.$exer_info[0]['exercise_id'];
                ?>
               
            </div>
            <div class="uploadedpic" style="margin-bottom: 20px;">
                <div class="uploadedsingle">
                    <div class="imguploaded"> <img alt="" src="<?php echo $media_image; ?>"></div>
                    <div class="Uptxt">Picture1</div>
                  </div>
                
            </div>
            <div class="descriptiohead"><span>VIDEOS</span>
                <?php
                $media_image = 'https://exorlive.com/media_'.$exer_info[0]['image_id'].'@80.80.media';
                $media_video = 'https://exorlive.com/video/?ex='.$exer_info[0]['exercise_id'];
                ?>
               
            </div>
            <div class="uploadedpic">
                <div class="uploadedsingle">
                    <div class="imguploaded"><iframe src="<?php echo $media_video; ?>" height="300px" width="500px"></iframe></div>
                    <div class="Uptxt">Video 1 </div>
                  </div>
                
            </div>
            
        </div>
      
</div>
