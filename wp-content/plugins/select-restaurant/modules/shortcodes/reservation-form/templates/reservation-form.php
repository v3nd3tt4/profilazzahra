<div class="qode-rf-holder">
	<?php if($open_table_id !== '') : ?>
		<form class="qode-rf" target="_blank" action="http://www.opentable.com/restaurant-search.aspx" name="qode-rf">
			<div class="qode-rf-row clearfix">
				<div class="qode-rf-col-holder">
					<div class="qode-rf-field-holder clearfix">
						<select name="partySize" class="qode-ot-people">
							<option value="1"><?php esc_html_e('1 Person', 'select-restaurant'); ?></option>
							<option value="2"><?php esc_html_e('2 People', 'select-restaurant'); ?></option>
							<option value="3"><?php esc_html_e('3 People', 'select-restaurant'); ?></option>
							<option value="4"><?php esc_html_e('4 People', 'select-restaurant'); ?></option>
							<option value="5"><?php esc_html_e('5 People', 'select-restaurant'); ?></option>
							<option value="6"><?php esc_html_e('6 People', 'select-restaurant'); ?></option>
							<option value="7"><?php esc_html_e('7 People', 'select-restaurant'); ?></option>
							<option value="8"><?php esc_html_e('8 People', 'select-restaurant'); ?></option>
							<option value="9"><?php esc_html_e('9 People', 'select-restaurant'); ?></option>
							<option value="10"><?php esc_html_e('10 People', 'select-restaurant'); ?></option>
						</select>
					<span class="qode-rf-icon">
						<span class="icon_group"></span>
					</span>
					</div>
				</div>
				<div class="qode-rf-col-holder">
					<div class="qode-rf-options-holder">
						<h5 class="qode-rf-label">
							<?php esc_html_e('Date', 'select-restaurant'); ?>
						</h5>
						<div class="qode-rf-field-holder clearfix">
							<input type="text" value="<?php echo date('m/d/Y'); ?>" class="qode-ot-date" name="startDate">
						<span class="qode-rf-icon">
							<span class="icon_table"></span>
						</span>
						</div>
					</div>
				</div>
				<div class="qode-rf-col-holder qode-rf-time-col">
					<div class="qode-rf-options-holder">
						<h5 class="qode-rf-label">
							<?php esc_html_e('Time', 'select-restaurant'); ?>
						</h5>
						<div class="qode-rf-field-holder clearfix">
							<select name="ResTime" class="qode-ot-time">
								<option value="6:30am">6:30 am</option>
								<option value="7:00am">7:00 am</option>
								<option value="7:30am">7:30 am</option>
								<option value="8:00am">8:00 am</option>
								<option value="8:30am">8:30 am</option>
								<option value="9:00am">9:00 am</option>
								<option value="9:30am">9:30 am</option>
								<option value="10:00am">10:00 am</option>
								<option value="10:30am">10:30 am</option>
								<option value="11:00am">11:00 am</option>
								<option value="11:30am">11:30 am</option>
								<option value="12:00am">12:00 pm</option>
								<option value="12:30am">12:30 pm</option>
								<option value="1:00pm">1:00 pm</option>
								<option value="1:30pm">1:30 pm</option>
								<option value="2:00pm">2:00 pm</option>
								<option value="2:30pm">2:30 pm</option>
								<option value="3:00pm">3:00 pm</option>
								<option value="3:30pm">3:30 pm</option>
								<option value="4:00pm">4:00 pm</option>
								<option value="4:30pm">4:30 pm</option>
								<option value="5:00pm">5:00 pm</option>
								<option value="5:30pm">5:30 pm</option>
								<option value="6:00pm">6:00 pm</option>
								<option value="6:30pm">6:30 pm</option>
								<option value="7:00pm" selected="selected">7:00 pm</option>
								<option value="7:30pm">7:30 pm</option>
								<option value="8:00pm">8:00 pm</option>
								<option value="8:30pm">8:30 pm</option>
								<option value="9:00pm">9:00 pm</option>
								<option value="9:30pm">9:30 pm</option>
								<option value="10:00pm">10:00 pm</option>
								<option value="10:30pm">10:30 pm</option>
								<option value="11:00pm">11:00 pm</option>
								<option value="11:30pm">11:30 pm</option>
							</select>
						<span class="qode-rf-icon">
							<span class="icon_clock_alt"></span>
						</span>
						</div>
					</div>
				</div>
				<div class="qode-rf-col-holder qode-rf-btn-holder">
					<?php if(stockholm_qode_restaurant_theme_installed()) : ?>
						<?php echo stockholm_qode_execute_shortcode('qbutton',
							array(
								'text' => esc_html__('Book a Table', 'select-restaurant'),
                                'html_type' => 'button'
							)
						) ?>
					<?php else: ?>
						<input type="submit" class="qbutton qode-btn-solid" name="qode-rf-time">
					<?php endif; ?>
				</div>
			</div>

			<input type="hidden" name="RestaurantID" class="RestaurantID" value="<?php echo esc_attr($open_table_id); ?>">
			<input type="hidden" name="rid" class="rid" value="<?php echo esc_attr($open_table_id); ?>">
			<input type="hidden" name="GeoID" class="GeoID" value="15">
			<input type="hidden" name="txtDateFormat" class="txtDateFormat" value="MM/dd/yyyy">
			<input type="hidden" name="RestaurantReferralID" class="RestaurantReferralID" value="<?php echo esc_attr($open_table_id); ?>">

		</form>
	<?php else: ?>
		<p><?php esc_html_e('You haven\'t added OpenTable ID', 'select-restaurant'); ?></p>
	<?php endif; ?>
</div>