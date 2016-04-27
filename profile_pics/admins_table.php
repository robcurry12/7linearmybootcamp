	<table class="admin_db_tables" id="admins_table">
		<tr>
			<td class="admin_table_headers"><b>Username</b></td>
			<td class="admin_table_headers"><b>Became Admin</b></td>
			<td class="admin_table_headers"><b>Remove Admin</b></td>
		</tr>
		<?php foreach ($admins as $admin) : ?>
		<tr>
			<td class="admin_table_users_and_reports"><?php echo $admin['username']; ?>
													<?php if(isAdmin($admin['username']))
														{
															echo "<img src='images/admin.png' alt='Admin' title='Admin' style='height: 20px' />";
														}?></td>
			<td class="admin_table_users_and_reports"><?php echo date_format(new DateTime($admin['became_admin']), 'n/j/y'); ?></td>
			<td class="admin_table_users_and_reports"><img class="remove_admin" data-user-type="<?php echo $admin['username']; ?>" src="images/x.png" alt="Remove Admin" title="Remove Admin" style="height: 20px"/></td>
		</tr>
	<?php endforeach ?>	
	</table>