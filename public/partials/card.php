<article class="gridChild dropShadow">
    <div class="cardStyle">
        <div class="spacing">
            <div class="flex">
            <span class="statusCircle <?php echo h($music_row['status'] == 0 ? 'incomplete' : 'complete') ?>"></span>
                <h3 class="name"><?php echo h($music_row['name']); ?></h3>
                <div class="icons flex">
                    <a href="<?php echo get_public_url('/notes/edit.php?id=' . h($music_row['id'])); ?>" title="Edit Notes">
                        <svg width="46" height="49" viewBox="0 0 46 49" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M42.3142 11.0278L34.3267 6.01214L21.3219 26.7242L29.3045 31.7349L42.3142 11.0278ZM20.1039 33.0931L19.9275 37.7989L24.0927 35.5952L27.9661 33.5513L20.2637 28.712L20.1039 33.0931ZM44.4454 3.40789L40.2703 0.782205C39.7654 0.465411 39.1553 0.362112 38.5742 0.49502C37.9932 0.627927 37.4886 0.986161 37.1716 1.49096L35.5234 4.1084L43.5059 9.12241L45.1542 6.50827C45.8135 5.45338 45.5003 4.0639 44.4454 3.40459V3.40789ZM37.91 42.6695C37.91 43.1228 37.5392 43.4936 37.0859 43.4936H5.76892C5.55035 43.4936 5.34072 43.4068 5.18617 43.2522C5.03162 43.0977 4.94479 42.8881 4.94479 42.6695V11.3525C4.94479 11.1339 5.03162 10.9243 5.18617 10.7698C5.34072 10.6152 5.55035 10.5284 5.76892 10.5284H27.5985L30.7038 5.58359H5.76892C2.58777 5.58359 0 8.17137 0 11.3525V42.6695C0 45.8506 2.58777 48.4384 5.76892 48.4384H37.0859C40.2671 48.4384 42.8548 45.8506 42.8548 42.6695V16.3583L37.91 24.2304V42.6744V42.6695Z" fill="#F3B721"/>
                        </svg>
                    </a>
                    <a href="<?php echo get_public_url('/notes/delete.php?id=' . h($music_row['id'])); ?>" title="Delete Note">
                        <svg width="38" height="48" viewBox="0 0 38 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M37.3333 2.66667H28L25.3333 0H12L9.33333 2.66667H0V8H37.3333M2.66667 42.6667C2.66667 44.0812 3.22857 45.4377 4.22876 46.4379C5.22896 47.4381 6.58551 48 8 48H29.3333C30.7478 48 32.1044 47.4381 33.1046 46.4379C34.1048 45.4377 34.6667 44.0812 34.6667 42.6667V10.6667H2.66667V42.6667Z" fill="#F3B721"/>
                        </svg>
                    </a>
                </div>
            </div>
            <h3>Chords:</h3>
            <p><?php echo h($music_row['chords']); ?></p>
            <h3>Scales:</h3>
            <p><?php echo h($music_row['scales']); ?></p>
            <h3>BPM:</h3>
            <p><?php echo h($music_row['bpm']); ?></p>
            <div>
                <h3 class="date">Date:</h3>
                <span><?php echo h(date( 'Y M, j',strtotime($music_row['timeline']))); ?></span>
            </div>
        </div>
    </div>
</article>