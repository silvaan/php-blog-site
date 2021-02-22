<?php include "inc/header.php"; ?>
<div class="grid_10">
	<div class="box round first grid">
		<h2>Post List</h2>
		<div class="block">
			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th width="5%">Sl. No</th>
						<th width="12%">Title</th>
						<th width="18%">Body</th>
						<th width="11%">Image</th>
						<th width="8%">Category</th>
						<th width="12%">Description</th>
						<th width="7%">Author</th>
						<th width="8%">Tags</th>
						<th width="9%">Date</th>
						<th width="10%">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$query = "SELECT tbl_post.*, tbl_pages.name
							FROM tbl_post
							INNER JOIN tbl_pages
							ON tbl_post.cat = tbl_pages.id
							ORDER BY tbl_post.id DESC";
					$post  = $db->select($query);
					if ($post) {
						$i = 1;
						while ($result = $post->fetch_assoc()) {
							$i++
					?>
							<tr class="odd gradeX">
								<td><?php echo $i; ?></td>
								<td><?php echo $result["title"]; ?></td>
								<td><?php echo $fm->shortText($result["body"], 55); ?></td>
								<td><img src="<?php echo $result['image']; ?>" height="60" width="100" alt="<?php echo $result['image_alt']; ?>"></td>
								<td><?php echo $result["name"]; ?></td>
								<td><?php echo $result["description"]; ?></td>
								<td><?php echo $result["author"]; ?></td>
								<td><?php echo $result["tags"]; ?></td>
								<td class="center"><?php echo $fm->dateFormat($result["date"]); ?></td>
								<td>
									<a href="viewpost.php?viewpostid=<?php echo $result["id"]; ?>">View</a>
									<?php if (Session::get('userId') == $result['userid'] || Session::get('role') == '0') { ?>
										|| <a href="editpost.php?editpostid=<?php echo $result["id"]; ?>">Edit</a> ||
										<a onclick="return confirm('Are you want to Delete?');" href="delpost.php?delpostid=<?php echo $result['id']; ?>">Delete</a><?php } ?>
								</td>
							</tr>
					<?php }
					} ?>
				</tbody>
			</table>

		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		setupLeftMenu();
		$('.datatable').dataTable();
		setSidebarHeight();
	});
</script>
<?php include "inc/footer.php"; ?>