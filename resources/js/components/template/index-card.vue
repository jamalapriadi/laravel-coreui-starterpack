<template>
  <div class="card card-accent-primary">
    <div class="card-header">
      {{ title }}

      <div class="card-header-actions d-print-none">
        <slot name="actions">
          <router-link v-if="createLink" :to="createLink" class="btn btn-primary">
            <i class="fa fa-plus"></i> Tambah Baru
          </router-link>
          <slot name="actions-extra" />
        </slot>
      </div>
    </div>

    <div class="card-body">

      <slot name="beforefilter" />

      <div class="row d-print-none" v-if="undefined === noFilter">
        <div class="col-lg-5">
          <form class="form-inline">
            <div class="form-group">
              <label for="form_q" class="control-label col-lg-4">FILTER:</label>
              <div class="col-lg-8">
                <input type="text" class="form-control" id="form_q" placeholder="Type to search" v-model="keyword" autocomplete="off">
              </div>
            </div>
          </form>
        </div>
      </div>

      <br>

      <div class="table-responsive">
        <table class="table table-striped">
          <thead>
            <slot name="thead">
              <tr>
                  <th width="5%">No.</th>
                  <th v-for="(field, label) in fields" :key="label">{{ label }}</th>
                  <th width="7%"></th>
              </tr>
            </slot>
          </thead>
            <tbody>
              <slot name="tbody">
                <tr v-for="(row, index) in source.data" v-bind:key="index">
                  <td>{{ source.from + index }}</td>
                  <td v-for="(field, label) in fields" :key="label">{{ rowValue(row, field) }}</td>
                  <td>
                    <div class="btn-group d-print-none">
                      <router-link v-if="updateLink" :to="{ name: updateLink, params: {id: row[cid]}}" class="btn btn-warning">
                        <i class="fa fa-edit text-white" />
                      </router-link>
                      <button v-if="deleteLink" type="button" class="btn btn-danger" @click="rowDelete(row[cid])">
                        <i class="fa fa-trash text-white" />
                      </button>
                      <slot name="controls-extra" :row="row" />
                    </div>
                  </td>
                </tr>
                <tr v-if="!source.data || !source.data.length">
                  <td :colspan="2 + Object.keys(fields).length "><em>No data found</em></td>
                </tr>
              </slot>
            </tbody>
        </table>
      </div>

      <vue-loading v-if="progress.loading" type="bars" color="#d9544e" :size="loadingSize" />
      <b-alert :show="progress.message" :variant="alert" dismissible>{{ progress.message }}</b-alert>

      <div class="d-print-none" style="margin-top: 20px">
        <pagination :data="source" :limit="3" @pagination-change-page="loadSource" :show-disabled="true" />
      </div>
    </div>
  </div>
</template>

<script>
import { VueLoading } from 'vue-loading-template'

export default {
  components: {
    VueLoading,
  },
  props: [
    'title',
    'fid',
    'fields',
    'queries',
    'sourceLink',
    'createLink',
    'updateLink',
    'deleteLink',
    'noFilter',
  ],
  data: props => ({
    source: {},
    page: 1,
    keyword: null,
    progress: {
      loading: false,
      message: null,
      success: false,
    },
    loadingSize: {
      width: '50px',
      height: '50px',
    },
    loadingSource: null,
  }),
  computed: {
    cid: props => props.fid || 'id',
    alert: function() {
      return this.progress.success ? 'success' : 'danger'
    },
  },
  mounted() {
    this.loadSource();
  },
  watch: {
    keyword: function() {
      this.loadSource()
    },
    queries: {
      handler: function() {
        this.loadSource()
      },
      deep: true
    }
  },
  methods: {
    loadingStart() {
      this.progress = {
        loading: true,
        message: null,
        success: false,
      }
    },
    loadingStop(message, success) {
      this.progress = {
        loading: false,
        message: message || null,
        success: success || false,
      }
    },
    handleResponse(res, errorMessage) {
      let message, success

      if (res) {
        message = res.data.message || res.statusText
        success = res.data.success
      } else {
        message = errorMessage
      }

      this.loadingStop(message || 'Unknown error!', success)
    },
    loadSource(page) {
      clearTimeout(this.loadingSource)

      this.loadingSource = setTimeout(() => {
        this.loadingStart()

        let source = this.sourceLink + '?page=' + (page || this.page)

        if (this.keyword) {
          source += '&q=' + this.keyword
        }

        if (this.queries) {
          source += '&' + Object.keys(this.queries).filter(q => this.queries[q]).map(q => `${q}=${this.queries[q]}`).join('&')
        }

        if (page) {
          this.page = page
        }

        axios.get(source)
          .then(response => {
            this.loadingStop()
            this.source = response.data;
          })
          .catch(e => this.handleResponse(e.response, e.message))
        ;
      }, 300)
    },
    rowDelete(id) {
      this.$swal({
        title: 'Are you sure?',
        text: 'You can\'t revert your action',
        type: 'warning',
        showCancelButton: true,
        cancelButtonText: 'No, Keep it',
        confirmButtonText: 'Yes Delete it',
        showCloseButton: true,
      })
      .then(result => {
        if (result.value) {
          this.loadingStart()

          axios
            .delete(this.deleteLink.replace(':id', id))
            .then(res => {
              this.handleResponse(res)

              if (this.progress.success) {
                this.$swal({
                  title: 'Deleted',
                  text: this.progress.message,
                  type: 'info',
                  confirmButtonText: 'OK',
                })
                .then(result => this.loadSource())
              }
            })
            .catch(e => this.handleResponse(e.response, e.message))
          ;
        }
      })
    },
    rowValue: (row, field) => 'function' === typeof field ? field(row, field) : _.get(row, field),
  }
}
</script>
