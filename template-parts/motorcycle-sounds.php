<?php if ($sounds = gomoto_get_motorcycle_sounds()): ?>                                                     
    <div class="product__sounds">
        <div class="product__sounds-title h4">
            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="32" height="24" x="0" y="0" viewBox="0 0 512 384" xml:space="preserve">
                <g>
                    <path d="M192,0C86.112,0,0,86.112,0,192s86.112,192,192,192s192-86.112,192-192S297.888,0,192,0z M144,272V112l128,80L144,272z" fill="#ff9800"></path>
                    <path d="M448,128c-8.832,0-16,7.168-16,16v96c0,8.832,7.168,16,16,16s16-7.168,16-16v-96C464,135.168,456.832,128,448,128z" fill="#ff9800"></path>
                    <path d="M496,160c-8.832,0-16,7.168-16,16v32c0,8.832,7.168,16,16,16s16-7.168,16-16v-32C512,167.168,504.832,160,496,160z" fill="#ff9800"></path>
                    <path d="M400,96c-8.832,0-16,7.168-16,16v160c0,8.832,7.168,16,16,16s16-7.168,16-16V112C416,103.168,408.832,96,400,96z" fill="#ff9800"></path>
                </g>
            </svg>
            <span>Послушать звук мотора</span>
        </div>
        <div class="product__sounds-body">
            <?php foreach($sounds as $sound):
                $sound_id = $sound['file_id'];
                $sound_url = wp_get_attachment_url( $sound_id );
                $sound_type = get_post_mime_type( $sound_id );
                ?>
                <div class="product__sound">
                    <?php if ($sound_label = $sound['label']): ?>
                        <span><?= esc_html($sound['label']); ?></span>
                    <?php endif; ?>
                    <?php if ( $sound_url ) : ?>
                        <audio controls preload="none">
                            <source
                                src="<?php echo esc_url( $sound_url ); ?>"
                                type="<?php echo esc_attr( $sound_type ); ?>"
                            >
                        </audio>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>
