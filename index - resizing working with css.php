<?php  require_once 'core/init.php';?>
<!DOCTYPE html>
	<?php include'includes/head.php';?>
		<title><---Bad Fraggle's Reptiles---></title>
			<?php include'includes/banner.php'; ?>
				<div class="box box-2">
				<article class="main">
					<div class="main-page main-page-2">
						<h3>Species list</h3>
							<h3>Reptile list</h3>
							<table>
								<thead>
									<tr>
										<th>Morph</th>
										<th>Common name</th>
										<th>Latin name</th>
										<th>Added by</th>
										<th>Added on</th>
										<th>Photo</th>
								</thead>
								<tbody>
									<?php
										$image = DB::getInstance()->query("SELECT * FROM images");
										foreach($image->results() as $image){ 
									?>
										<tr>
											 <td><?php echo escape(ucfirst($image->morph));?></td>
											<td>
												<?php
													$common = $image->speciesid;
													$sql = 'SELECT * FROM species WHERE id = :id';
													$stmt = $pdo->prepare($sql);
													$stmt->execute(['id' => $common]);
													$comm = $stmt->fetch();

													echo escape(ucfirst($comm->common));
												?>
											</td>
											<td> 
												<?php echo escape(ucfirst($comm->latin));?>	
											</td>
											  <td> 
												<?php
													$user = $image->added_by_user_id;
													$sql = 'SELECT * FROM users WHERE id = :id';
													$stmt = $pdo->prepare($sql);
													$stmt->execute(['id' => $user]);
													$username = $stmt->fetch();

													echo escape(ucfirst($username->username));
												?>	
											</td>
											<td> 
												<?php 
													$dateStr = $image->timedate_added;
													$date = new DateTime(eval('return \'' . $dateStr . '\';'));
													echo $date->format('l jS F Y <\b\r> \a\t\ g:i A');
												?>
											</td>
											<td class="resizeImage"> 
												<?php 												
													$pic = escape($image->image_address);

													$thumb = $pic;
													$thumb = resize_image($tempname,"150");
													
													echo '<a " href="' . $pic . '" ><img class="img" src="'. $thumb . '" alt=" A Image" /></a>';
												?>
											</td>	
										</tr>
									<?php } ?>	
								</tbody>
							</table>
						</div>
				</article>
				<?php include'includes/left.php'; ?>
				<?php include'includes/right.php'; ?>
				<?php include'includes/footer.php'; ?>