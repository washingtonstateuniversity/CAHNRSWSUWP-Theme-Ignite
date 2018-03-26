<div class="cahnrs-pagnination basic-display"><form method="get">
<div class="page-nav prev-nav"><button type="submit" class="<?php if ( $this->page <= 1 ) : ?> is-disabled<?php endif; ?>" type="submit" name="ci-page" value="<?php echo esc_html( $this->prev_page ); ?>" <?php if ( $this->page <= 1 ) : ?> disabled="disabled"<?php endif; ?>><i class="fa fa-caret-left" aria-hidden="true"></i>
</button></div>
	<div class="pages">
	<?php for ( $i = $start_index; $i <= $end_index; $i++ ) : ?><input class="<?php if ( $i == $this->page ) : ?> is-current<?php endif; ?>" type="submit" name="ci-page" value="<?php echo esc_html( $i ); ?>" /><?php endfor; ?>
	</div>
	<?php if ( $last_index ) : ?>
	<div class="page-filler">...</div>
	<div class="pages-end"><input type="submit" name="ci-page" value="<?php echo esc_html( $last_index ); ?>" /></div>
	<?php endif; ?>
<div class="page-nav prev-nav"><button type="submit" class="<?php if ( $this->page >= $this->pages ) : ?> is-disabled<?php endif; ?>" type="submit" name="ci-page" value="<?php echo esc_html( $this->next_page ); ?>" <?php if ( $this->page >= $this->pages ) : ?> disabled="disabled"<?php endif; ?>><i class="fa fa-caret-right" aria-hidden="true"></i>
</button></div><div class="page-count">Showing page <?php echo esc_html( $this->page ); ?> of <?php echo esc_html( $this->pages ); ?></div>
</form></div>
