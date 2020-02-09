<div class="col-md-offset-0 col-md-12">
<div class="box  box-success">
	<div class="box-header with-border">
		

	</div>
	<div class="box-body">
<div class="table-responsive">
		<table id="example1" class="table table-bordered table-striped table-responsive ">
			<thead>
			<tr>
				<th>Sl</th>
				<th>Email</th>
				<th>Created date</th>
				<th>Status</th>
				<th>Action</th>

			</tr>
			</thead>
			<tbody>
			<?php if (isset($newsletters)){
            $count = 0;
            foreach ($newsletters as $news) {
    ?>
    <tr>
        <td><?php echo ++$count; ?></td>
        <td><?php echo $news->newsletter_email; ?></td>
        <td><?php echo $news->created_time; ?></td>
        
		<?php if($news->status==0){

			?>
			<td><button class="btn btn-danger"> Unread</button></td>
			<?php }  else {  ?>
			<td><button class="btn btn-success"> Read</button></td>

		<?php }?>



        <td>
            <a title="delete"
               href="<?php echo base_url() ?>subscriber-status/<?php echo $news->newsletter_id; ?>"
              >
                <span class="glyphicon glyphicon-eye-open btn btn-success"></span>
            </a>
<!--			<a title="delete"-->
<!--			   href="--><?php //echo base_url() ?><!--inquery-delete/--><?php //echo $news->newsletter_id; ?><!--"-->
<!--			   onclick="return confirm('Are you want to delete this information :press Ok for delete otherwise Cancel')">-->
<!--				<span class="glyphicon glyphicon-trash btn btn-danger"></span>-->
<!--			</a>-->
        </td>
    </tr>
			<?php }  } ?>

			</tbody>

		</table>
</div>


	</div>

</div>
</div>
