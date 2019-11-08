<template>
  <form @submit.prevent="formSave" :method="formMethod" novalidate v-bind="attributes">
    <vue-loading v-if="loading" type="bars" color="#d9544e" :size="loadingSize" />
    <b-alert v-model="show" :variant="alert" dismissible>{{ message }}</b-alert>

    <div v-for="(row, name) in rows" :key="name" class="form-group row">
      <label :for="row.id" class="col-lg-3 control-label">{{ row.label }}</label>
      <div class="col-lg-7">
        <template v-if="'date' === row.type">
          <datepicker v-validate="row.rules" :name="name" v-model="dates[name]" :id="row.id" :placeholder="row.label" @selected="v => rowDateChange(row, v)" :format="dateFormat" />
        </template>
        <template v-else-if="'textarea' === row.type">
          <textarea v-validate="row.rules" :name="name" v-model="values[name]" class="form-control" :id="row.id" :placeholder="row.label" />
        </template>
        <template v-else-if="'image' === row.type">
          <div v-if="values[name]" style="margin-bottom: 20px">
            <img v-bind:src="values[name]" class="img-fluid">
          </div>
          <input v-validate="row.rules" :name="name" class="form-control" :id="row.id" @change="rowFileChange(row, $event)" type="file" accept="image/*">
        </template>
        <template v-else-if="'select' === row.type">
          <multiselect v-validate="row.rules" :name="name" v-model="selected[name]" :id="row.id" @select="v => rowSelectChange(row, v)" v-bind="row.props" />
        </template>
        <template v-else-if="'radio' === row.type">
          <b-form-radio-group v-validate="row.rules" :name="name" :id="row.id" v-model="values[name]" :options="row.options" />
        </template>
        <template v-else>
          <input v-validate="row.rules" :name="name" v-model="values[name]" :id="row.id" :placeholder="row.label" class="form-control" type="text">
        </template>

        <div v-for="error in $errors.collect(name)" class="invalid-feedback d-block">{{ error }}</div>
      </div>
    </div>

    <vue-loading v-if="loading" type="bars" color="#d9544e" :size="loadingSize" />
    <b-alert v-model="show" :variant="alert" dismissible>{{ message }}</b-alert>

    <hr>
    <button class="btn btn-primary" :disabled="formDisabled($fields, loading)">
      <i class="icon-floppy-disk" /> {{ saveLabel || 'Save' }}
    </button>
    <router-link v-if="backLink" :to="backLink" class="btn btn-secondary">
      <i class="fa fa-reply" /> {{ cancelLabel || 'Cancel' }}
    </router-link>
  </form>
</template>

<script>
import { VueLoading } from 'vue-loading-template'
import Datepicker from 'vuejs-datepicker'

const FORM_SEED = 'seed__'

export default {
  components: {
    VueLoading,
    Datepicker,
  },
  props: [
    'action',
    'method',
    'saveLabel',
    'cancelLabel',
    'items',
    'attributes',
    'backLink',
    'seed',
    'seedLink',
  ],
  computed: {
    formMethod: props => props.method || 'post',
    alert: function() {
      return this.success ? 'success' : 'danger'
    },
  },
  data: props => {
    let keys = props.items ? Object.keys(props.items) : []
    let sources = false === props.seed ? [] : [[FORM_SEED, props.seedLink || props.action]]

    return {
      keys,
      rows: _.fromPairs(keys.map(key => [key, _.assign({
        id: 'form_' + key,
        name: key,
        label: key.replace(/((?:^[a-z])|(?:[-_][a-z]))/ig, $1 => $1.toUpperCase().replace('_', ' ')),
        props: {},
        source: null,
        rules: null,
      }, props.items[key])])),
      sources: sources.concat(keys
        .filter(key => props.items[key].source)
        .map(key => [key, props.items[key].source])
      ),
      values: _.fromPairs(keys.map(key => [key, null])),
      dates: _.fromPairs(keys.filter(key => 'date' === props.items[key].type).map(key => [key, null])),
      selected: _.fromPairs(keys.filter(key => 'select' === props.items[key].type).map(key => [key, null])),
      message: null,
      show: false,
      success: false,
      loading: false,
      loadingSize: {
        width: '50px',
        height: '50px',
      },
    }
  },
  methods: {
    loadingStart() {
      this.loading = true
      this.message = null
      this.show = false
    },
    loadingStop(message, success) {
      this.loading = false
      this.message = message || null
      this.show = this.message ? true : false
      this.success = success || false
    },
    handleResponse(res, errorMessage) {
      let message, success

      if (res) {
        message = res.data.message || res.statusText
        success = res.data.success

        if (res.data.errors) {
          this.$errors.clear()
          Object.keys(res.data.errors).forEach(field => res.data.errors[field].forEach(msg => this.$errors.add({field, msg})))
        }
      } else {
        message = errorMessage
      }

      this.loadingStop(message || 'Unknown error!', success)
    },
    formDisabled: (fields, loading) => loading || Object.keys(fields).some(key => fields[key].validated && fields[key].invalid),
    formSave: function() {
      this.loadingStart()

      axios
        .request({
          url: this.action,
          data: this.values,
          method: this.formMethod,
        })
        .then(res => {
          this.handleResponse(res)

          if (this.success) {
            this.$swal({
              title: 'Success',
              text: this.message,
              type: 'success',
              confirmButtonText: this.backLink ? 'Return' : 'OK',
            })
            .then(result => this.backLink ? this.$router.push(this.backLink) : null)
          }
        })
        .catch(e => this.handleResponse(e.response, e.message))
      ;
    },
    dateFormat: function(date) {
      return this.$moment(date).format('YYYY-MM-DD')
    },
    rowFileChange: function(row, e) {
      let files = e.target.files || e.dataTransfer.files;

      if (files.length) {
        let reader = new FileReader();
        reader.onload = e => this.values[row.name] = e.target.result
        reader.readAsDataURL(files[0])
      }
    },
    rowSelectChange: function(row, value) {
      this.values[row.name] = value[row.props.trackBy]
    },
    rowDateChange: function(row, value) {
      this.values[row.name] = this.dateFormat(value)
    },
  },
  mounted() {
    if (this.sources) {
      this.loadingStart()

      axios.all(this.sources.map(source => axios.get(source[1])))
        .then(responses => {
          this.sources.forEach((v, i) => {
            let name = v[0]
            let data = responses[i].data

            if (FORM_SEED === name) {
              this.values = data
            } else {
              this.rows[name].props.options = data
            }
          })

          this.loadingStop()
        })
        .then(() => {
          this.sources.forEach(v => {
            let name = v[0]

            if (FORM_SEED === name) {
              Object.keys(this.dates).forEach(key => this.dates[key] = this.values[key] || this.dates[key])
            } else if ('select' === this.rows[name].type) {
              let by = this.rows[name].props.trackBy
              let matches = this.rows[name].props.options.filter(option => option[by] == this.values[name])

              if (matches) {
                this.selected[name] = matches[0]
              }
            }
          })
        })
        .catch(e => {
          this.handleResponse(e.response, e.message)

          this.$swal({
            title: 'Data Loading Error',
            text: this.message,
            type: 'error',
            confirmButtonText: 'Return',
          })
          .then(result => this.backLink ? this.$router.push(this.backLink) : null)
        })
      ;
    }
  }
}
</script>
