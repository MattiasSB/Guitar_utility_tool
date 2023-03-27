<article class="col-span-6">
    <div class="rounded overflow-hidden shadow-lg border">
        <div class="px-6 py-4">
            <div class="flex items-center">
                <h3 class="font-bold text-2xl mb-1 flex-grow"><?php echo h($music_row['name']); ?></h3>
                <!--taken from class example to add functionality--> 
                <!--Changes color of the status badge based on the database value of 0 or 1 (acts as if it is an if statement)--> 
                <span class="text-white rounded-full text-sm bg-<?php echo $music_row['status'] == 0 ? 'yellow' : 'green'; ?>-500 px-3 py-1"><?php echo $music_row['status'] == 0 ? 'Incomplete' : 'Complete'; ?></span>
                <a href="<?php echo get_public_url('/notes/edit.php?id=' . h($music_row['id'])); ?>" class="text-white rounded-full text-sm bg-purple-500 px-3 py-1 ml-2">Edit</a>
                <a href="<?php echo get_public_url('/notes/delete.php?id=' . h($music_row['id'])); ?>" class="text-white rounded-full text-sm bg-red-500 px-3 py-1 ml-2">Delete</a>
            </div>
            <h3 class="font-bold text-2xl mb-1 flex-grow">Chords:</h3>
            <p class="text-xl my-4"><?php echo h($music_row['chords']); ?></p>
            <h3 class="font-bold text-2xl mb-1 flex-grow">Scales:</h3>
            <p class="text-xl my-4"><?php echo h($music_row['scales']); ?></p>
            <h3 class="font-bold text-2xl mb-1 flex-grow">BPM:</h3>
            <p class="text-xl my-4"><?php echo h($music_row['bpm']); ?></p>
            <div class="text-gray-700 text-lg flex ">
                <h3 class="font-bold text-2xl mb-1 flex-grow">Complete by:</h3>
                <img class="w-5 inline-block" src="<?php echo get_public_url('/images/cal.svg'); ?>" alt="Calendar Icon">
                <span class="ml-2"><?php echo h(date( 'Y M, j',strtotime($music_row['timeline']))); ?></span>
            </div>
        </div>
    </div>
</article>