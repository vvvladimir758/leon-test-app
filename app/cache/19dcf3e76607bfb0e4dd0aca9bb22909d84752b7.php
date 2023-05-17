

<?php $__env->startSection('title'); ?>
    Основная
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
   <div id="vueTable">
    
    <div v-for="(item, index) in data" :key="index">
      <div v-for="(it, ind) in item" :key="ind">
          <p>{{ it.Region }}</p>
      
      </div>
    </div>
    
           <table class="table">
  <thead>
    <tr>

      <th scope="col" @click="sortBy('Continent');"  ><a href="#hj">Continent</a></th>
      <th scope="col"  @click="sortBy('Region');"><a href="#">Region</a></th>
      <th scope="col"  @click="sortBy('Countries');"><a href="#">Countries</a></th>
       <th scope="col"  @click="sortBy('LifeDuration');"><a href="#">Life duration</a></th>
        <th scope="col"  @click="sortBy('Population');"><a href="#">Population</a></th>
         <th scope="col"  @click="sortBy('Cities');"><a href="#">Cities</a></th>
          <th scope="col"  @click="sortBy('Languages');"><a href="#">Languages</a> </th>

    </tr>
  </thead>
  <tbody>
 
    <tr v-for="(item, index) in data" :key="index">
      <td>{{ item.Continent }}</td>
      <td>{{ item.Region }}</td>
      <td>{{ item.Countries }}</td>
       <td>{{ item.LifeDuration }}</td>
      <td>{{ item.Population }}</td>
      <td>{{ item.Cities }}</td>
       <td>{{ item.Languages }}</td>
    </tr>
        
    </tbody>
    </table>
    
    
           <nav aria-label="Page navigation example">
  <ul class="pagination">
   <li class="page-item"><a class="page-link" href="<?php echo e($sitePath); ?>main_vue/<?php echo e(($page-1) > 0 ? ($page-1) : 1); ?>"><</a></li>
  <?php $__currentLoopData = $pageCount; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $n): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  
    <li class="page-item"><a class="page-link <?php echo e($page == $n ? 'active' : ''); ?>" href="<?php echo e($sitePath); ?>main_vue/<?php echo e($n); ?>"><?php echo e($n); ?></a></li>
 
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
       <li class="page-item"><a class="page-link" href="<?php echo e($sitePath); ?>main_vue/ <?php echo e(($page+1) < count($pageCount) ? ($page+1) : count($pageCount)); ?>">></a></li>
  </ul>
</nav> 

</div>
          
 <script src="https://unpkg.com/vue@3.3.2"></script> 
 <script src="https://unpkg.com/axios/dist/axios.min.js"></script>  
<script>
const App = {
  data(){
        return{
          orderType: 'desc',
          data:''
        };
    },

  created(){
      this.getData();
 
  },

  methods:{
    sortBy(type){
    
         axios.get('<?php echo e($sitePath); ?>main_json/<?php echo e($page); ?>/type/'+this.orderType)
        .then(response => {
        this.data = response.data;
        if(this.orderType == 'desc'){
         this.orderType = 'asc';
        }
        else{
        this.orderType = 'desc';
        }
    
  }
        )
        .catch(error => this.userInfo = error.data);
    
    },
    getData(){
        axios.get('<?php echo e($sitePath); ?>main_json/<?php echo e($page); ?>')
        .then(response => {
        this.data = response.data;
        console.log(response.data);

  }
        )
        .catch(error => this.userInfo = error.data);

    },      
  } 
}

Vue.createApp(App).mount('#vueTable')

</script>    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OSPanel\domains\localhost\leon\app\views/vue_table.blade.php ENDPATH**/ ?>