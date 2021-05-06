<template>
<div>
    <h1><a :href="$route('welcome')">  {{ name }} </a> {{ newClass }}</h1>
</div>
        
</template>

<script>
  import Dashboard from '../Layout/Dashboard'

  export default {
    
    // Using the shorthand
    layout: Dashboard,

    props: ['name','newClass'],
  }
</script>