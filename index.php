<?php
include "Data/ConnectDAO.php";
addList();
selectUpdate();
updateList();
deleteList();
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Document</title>
		<link rel="stylesheet" href="style.css" />
		<link
			href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap"
			rel="stylesheet"
		/>
		<link
			rel="stylesheet"
			href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
			integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk"
			crossorigin="anonymous"
		/>
		<script
			src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
			integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
			crossorigin="anonymous"
		></script>
		<script
			src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
			integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
			crossorigin="anonymous"
		></script>
		<script
			src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
			integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
			crossorigin="anonymous"
		></script>
	</head>
	<body>
		<div class="container">
			<div class="row title d-flex justify-content-center align-items-center">
				<h1>To Do List</h1>
			</div>
			<div class="row form d-flex justify-content-center">
				<form name="formList" action="#" method="POST">
					<input
						class="inputAdd"
						type="text"
						placeholder="What need to be done?"
						name="content"
					/>
					<div class="showList">
						<div class="listItem">
							<?php foreach ($list as $i =>
    $value) {?>
							<div
								class="item d-flex flex-row justify-content-between align-items-center"
							>
								<div class="itemTop d-flex flex-row align-items-center">
									<a href="index.php?idDelete=<?php echo $value['id'] ?>">
										<img src="./assets/trash.svg" alt="" srcset="" />
									</a>

									<?php if ($i == $select) {?>
									<input
										type="text"
										id="editInput"
										name="edit"
										value="<?php echo $list[$select]['content'] ?>"
									/>
									<?php } else {?>
									<div>
										<p><?php echo $value['content'] ?></p>
									</div>
									<?php }?>
								</div>
								<div class="itemBot">
									<?php if ($i == $select) {?>
									<div>
										<button class="btnBot" name="btnBot" type="submit">
											<img src="./assets/heart.svg" alt="" srcset="" />
										</button>
									</div>
									<?php } else {?>
									<div>
										<a href="index.php?idSelect=<?php echo $i ?>">
											<img src="./assets/pencil.svg" alt="" srcset="" />
										</a>
									</div>
									<?php }?>
								</div>
							</div>
							<?php }?>
						</div>
						<div class="footerList">
							<p><?php echo count($list) ?> item left</p>
						</div>
					</div>
				</form>
			</div>
		</div>
	</body>
	<script>
		document.onkeydown = function (evt) {
			var keyCode = evt ? (evt.which ? evt.which : evt.keyCode) : event.keyCode;
			if (keyCode == 13) {
				document.formList.submit();
			}
		};
	</script>
</html>
