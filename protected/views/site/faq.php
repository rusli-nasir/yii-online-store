<section class="container">
<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">



		<h3>FAQs</h3>
		<hr>

		<?php 
		$translate=Yii::app()->translate;
		$lang = $translate->getLanguage();
		$data = Page::model()->findByAttributes(array(
				'type_id' => Page::TYPE_FAQ,
				'lang_type' => $lang
		));?>
			
		<?php if(!empty($data)){?>
			<?php 
				$p = new CHtmlPurifier();
				$content = trim($p->processOutput($data->content));
				echo "".$content;
			?>
		<?php }?>
	</div>
</div>
</div>
</div>
</section>

