

<style>
	.mobile_page_responsive{ margin-top: 35px  !important;}
	@media (max-width: 776px) {
		.mobile_page_responsive{ margin-top: 102px !important;}
		.breadcrum_mobile{ width: 113% !important;
			margin-left: -7px !important;
		}
	}
	.breadcrum_mobile{ width: 103%;

		margin-left: -3px;
	}

</style>
<div class="mobile_page_responsive " style="margin-bottom: 50px">
	<div class="container-fluid">

<div class="row">
	<div class="col-md-12 col-lg-12 col-12">
		<div class="subheader">
			<ul class="breadcrumb breadcrum_mobile">
				<li><a href="<?=base_url()?>">Home</a>/</li>
				<li class="active" style="margin-left: 5px;"><?=$page_title?></li>
			</ul>

			<div class="page-title ">
				<h1 class="text-center"><?=$page_title?></h1>
			</div>
			<br>
		</div>
		</div>


	<div class="col-md-12">

		<article class="txt">
			<?=$page_content?>
		</article>
	</div>


	</div>

	</div>
	</div>
