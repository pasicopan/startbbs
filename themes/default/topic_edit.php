<!DOCTYPE html>
<html>
<head>
<meta content='建议与想法 - ' name='description'>
<meta charset='UTF-8'>
<meta content='width=device-width, initial-scale=1.0' name='viewport'>
<title><?php echo $title?> - <?php echo $settings['site_name']?></title>
<?php $this->load->view('common/header-meta');?>
<script src="<?php echo base_url('static/common/js/plugins.js')?>" type="text/javascript"></script>
<!-- <script src="<?php echo base_url('static/common/js/jquery.upload.js')?>" type="text/javascript"></script> -->
<?php if($this->config->item('storage_set')=='local'){?>
<!-- <script src="<?php echo base_url('static/common/js/local.file.js')?>" type="text/javascript"></script> -->
<?php } else{?>
<script src="<?php echo base_url('static/common/js/qiniu.js')?>" type="text/javascript"></script>
<?php }?>
<link href="<?php echo base_url('static/common/editor.md/css/editormd.css');?>" media="screen" rel="stylesheet" type="text/css" />
<style media="screen">

</style>
</head>
<body id="startbbs">
<?php $this->load->view('common/header');?>
    <div class="container" style="width:90%;">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">编辑话题</h3>
                    </div>
                    <div class="panel-body">
<form accept-charset="UTF-8" action="<?php echo site_url('/topic/edit/'.$item['topic_id']);?>" class="simple_form form-horizontal" id="new_topic" method="post">
<input type="hidden" id="token" name="<?php echo $csrf_name;?>" value="<?php echo $csrf_token;?>">
<input name="uid" type="hidden" value="1" />
<input name="node_id" type="hidden" value="1" />
<div class="form-group">
<!-- <label for="topic_title" class="col-sm-1  control-label">标题</label> -->
<div class="col-sm-9">
  <input class="form-control" id="topic_title" maxlength="100" name="title" size="60" type="text" value="<?php echo $item['title']?>" />
</div>
<div class="col-sm-3">
  <select name="node_id" id="node_id" class="form-control">
  <?php if(set_value('node_id')){?>
  <option selected="selected" value="<?php echo set_value('node_id'); ?>"><?php echo $cate['cname']?>(已选)</option>
  <?php } else {?>
  <option selected="selected" value="<?php echo $cate['node_id'];?>"><?php echo $cate['cname'];?>(已选)</option>
  <?php } ?>
  <?php if($cates[0]) foreach($cates[0] as $c) {?>
  <optgroup label="&nbsp;&nbsp;<?php echo $c['cname']?>">
  <?php if($cates[$c['node_id']]) foreach($cates[$c['node_id']] as $sc){?>
  <option value="<?php echo $sc['node_id']?>"><?php echo $sc['cname']?></option>
  <?php } ?>
  <?php } ?>
  </select>
</div>

<span class="help-block red"><?php echo form_error('title');?></span>
<span class="help-block red"><?php echo form_error('node_id');?></span>
</div>

<!-- <div class="form-group">
<label for="category">版块</label>
</div> -->
<p>
</p>


<div class="form-group" id="textContain">
  <!-- class="form-control h500" -->
<textarea style="display:none;"  id="post_content" name="content" placeholder="话题内容" rows="10"><?php echo $item['content']?>
</textarea>
<span class="help-block red"><?php echo form_error('content');?></span>


</div>
    <button type="submit" name="commit" class="btn btn-primary btn-inverse">修改</button> <small class="text-muted">(支持 Ctrl + Enter 快捷键)</small> <span><a href="https://pandao.github.io/editor.md/examples/index.html">(markdown 编辑器说明)</a></span><!-- <span class='text-muted'>可直接粘贴链接和图片地址/发代码用&lt;pre&gt;标签</span> -->
    <!-- <span class="pull-right"> -->
      <!-- <?php if($this->config->item('storage_set')=='local'){?> -->
    <!-- <input id="upload_file" type="button" value="图片/附件" name="file" class="btn btn-default pull-right"> -->
    	<!-- <?php } else {?> -->
    	<!-- <input id="upload_tip" type="button" value="图片/附件"  class="btn btn-default"> -->
    <!--	--<input type="button" onclick="doUpload()" value="图片/附件"  class="btn btn-default">-->
    	<!-- <?php }?> -->
    </span>
</form>
                    </div>
                </div>
            </div><!-- /.col-md-8 -->



        </div><!-- /.row -->
    </div><!-- /.container -->
    <?php $this->load->view('common/footer');?>
<script src="<?php echo base_url('static/common/editor.md/editormd.min.js')?>"></script>
<script>
var testEditor;

          $(function() {
              testEditor = editormd("textContain", {
                  // width   : "100%",
                  height  : 800,
                  syncScrolling : "single",
                  path    : "<?php echo base_url('static/common/editor.md')?>/lib/",
                  imageUpload : true,
                  imageFormats : ["jpg", "jpeg", "gif", "png", "bmp", "webp"],
                  imageUploadURL : baseurl+"index.php/upload/upload_file/",
                  params:{
                    stb_csrf_token:$('#token').val()
                  }
              });

              /*
              // or
              testEditor = editormd({
                  id      : "test-editormd",
                  width   : "90%",
                  height  : 640,
                  path    : "../lib/"
              });
              */
          });

</script>
</body>
</html>
