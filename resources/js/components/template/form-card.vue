<template>
  <div class="card card-accent-success">
    <div class="card-header">{{ title }}</div>
    <div class="card-body">
      <my-form v-bind="forms" />
    </div>
  </div>
</template>

<script>
export default {
  props: [
    'title',
    'forms',
  ],
}
</script>
