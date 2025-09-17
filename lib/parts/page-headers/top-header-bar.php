<div id="global-top-header-bar" class="site-header">
	<nav class="top-header-bar-primary-nav">
	   <?php if ( is_active_sidebar( 'global-top-header-bar-primary' ) ) : dynamic_sidebar( 'global-top-header-bar-primary' ); ?>
	   <?php else: ?>
		<ul>
			<li class="college-name-logo">
				<a href="//cahnrs.wsu.edu">
					C<span>ollege of </span>A<span>gricultural, </span>H<span>uman, and </span>N<span>atural </span>R<span>esource </span>S<span>ciences</span>
				</a>
			</li>
		</ul>
		<?php endif; ?>
	</nav><nav class="top-header-bar-secondary-nav">
		<?php if ( is_active_sidebar( 'global-top-header-bar-secondary' ) ) : dynamic_sidebar( 'global-top-header-bar-secondary' ); ?>
	   	<?php else: ?>
		<a href="https://admission.wsu.edu/apply/">Apply</a><a href="https://admission.wsu.edu/connect/request-information/">Request Info</a><a href="https://foundation.wsu.edu/give/?fund=c39b3693-1ede-4044-aa2a-f5fed2b62638&utm_source=college-of-agricultural-human-and-natural-resource-sciences-excellence-fund&utm_medium=wsu-link&utm_campaign=agricultural-human-and-natural-resource-sciences">Give</a>
		<?php endif; ?>
	</nav>
</div>
