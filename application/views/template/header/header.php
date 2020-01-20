<body <?php if ( isset( $body_classes ) && is_array( $body_classes ) && count( $body_classes ) ) {
	echo 'class="page-container-bg-solid ' . implode( ' ', $body_classes ) . '"';
} ?>>

<div class="page-wrapper">
    <div class="page-wrapper-row">
        <div class="page-wrapper-top">

            <header>
				<?php
				// @see load_header()

                echo $header_menu;

				// print all set modal
				foreach ( $modals as $modal ) {
					$modal = 'header_' . $modal;
					echo $$modal;
				}
				?>

            </header>

        </div>
    </div>