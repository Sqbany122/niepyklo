<?php include('naglowek_admin.php'); ?>

<div class="container mainContainer">
	<div class="row justify-content-center reportPageRow"> 
		<h1>Zgłoszenia użytkowników</h1>
		<table class="table text-light table-bordered" style="background-color: #1f1f1f;">
			<thead>
				<tr class="text-center">
					<td>Treść zgłoszenia</td>
					<td>Użytkownik</td>
					<td>Data</td>
				</tr>
			</thead>
			<tbody>
				<?php 
					$report = new Report($default_db);
					$report->showReport();
				?>
			</tbody>
		</table>
	</div>
</div>
<?php require_once('/themes/inc/footer.php'); ?>