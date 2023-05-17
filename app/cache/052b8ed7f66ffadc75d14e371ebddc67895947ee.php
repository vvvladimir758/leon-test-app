

<?php $__env->startSection('title'); ?>
    Основная
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
   
     
           <table class="table" id="vueTable">
  <thead>
    <tr>

      <th scope="col"><a href="<?php echo e($sitePath); ?>main/<?php echo e($page); ?>/Continent/<?php echo e($orderType == 'desc' ? 'asc' : 'desc'); ?>">Continent</a></th>
      <th scope="col"><a href="<?php echo e($sitePath); ?>main/<?php echo e($page); ?>/Region/<?php echo e($orderType == 'desc' ? 'asc' : 'desc'); ?>">Region</a></th>
      <th scope="col"><a href="<?php echo e($sitePath); ?>main/<?php echo e($page); ?>/Countries/<?php echo e($orderType == 'desc' ? 'asc' : 'desc'); ?>">Countries</a></th>
       <th scope="col"><a href="<?php echo e($sitePath); ?>main/<?php echo e($page); ?>/LifeDuration/<?php echo e($orderType == 'desc' ? 'asc' : 'desc'); ?>">Life duration</a></th>
        <th scope="col"><a href="<?php echo e($sitePath); ?>main/<?php echo e($page); ?>/Population/<?php echo e($orderType == 'desc' ? 'asc' : 'desc'); ?>">Population</a></th>
         <th scope="col"><a href="<?php echo e($sitePath); ?>main/<?php echo e($page); ?>/Cities/<?php echo e($orderType == 'desc' ? 'asc' : 'desc'); ?>">Cities</a></th>
          <th scope="col"><a href="<?php echo e($sitePath); ?>main/<?php echo e($page); ?>/Languages/<?php echo e($orderType == 'desc' ? 'asc' : 'desc'); ?>">Languages</a></th>

    </tr>
  </thead>
  <tbody>

            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            
            <tr>
            <td><?php echo e($item->Continent); ?></td>
            <td><?php echo e($item->Region); ?></td>
            <td><?php echo e($item->Countries); ?></td>
            <td><?php echo e($item->LifeDuration); ?></td>
            <td><?php echo e($item->Population); ?></td>
            <td><?php echo e($item->Cities); ?></td>
            <td><?php echo e($item->Languages); ?></td>
            
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
    </table>
    
    
           <nav aria-label="Page navigation example">
  <ul class="pagination">
   <li class="page-item"><a class="page-link" href="<?php echo e($sitePath); ?>main/<?php echo e(($page-1) > 0 ? ($page-1) : 1); ?>"><</a></li>
  <?php $__currentLoopData = $pageCount; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $n): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  
    <li class="page-item"><a class="page-link <?php echo e($page == $n ? 'active' : ''); ?>" href="<?php echo e($sitePath); ?>main/<?php echo e($n); ?>"><?php echo e($n); ?></a></li>
 
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
       <li class="page-item"><a class="page-link" href="<?php echo e($sitePath); ?>main/ <?php echo e(($page+1) < count($pageCount) ? ($page+1) : count($pageCount)); ?>">></a></li>
  </ul>
</nav> 

          
   
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OSPanel\domains\localhost\leon\app\views/table.blade.php ENDPATH**/ ?>