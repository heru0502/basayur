<template>
  <div class="row">
    <div class="col-sm-4">
      <div class="card">

        <form @submit.prevent="submit">
          <div class="card-body">
            <img :src="form.image" class="img-fluid m-1">

            <div class="form-group">
              <label>Input</label>
              <input type="file" @input="form.image = $event.target.files[0]" class="form-control">
              <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                {{ form.progress.percentage }}%
              </progress>
            </div>

            <div class="form-group">
              <label>Voucher</label>
              <select v-model="form.voucher_id" class="form-control">
                <option></option>
                <option v-for="voucher in vouchers" :value="voucher.id">{{voucher.title}}</option>
              </select>
            </div>

            <div class="form-group">
              <label>Post</label>
              <select v-model="form.post_id" class="form-control">
                <option></option>
                <option v-for="post in posts" :value="post.id">{{post.title}}</option>
              </select>
            </div>

            <div class="form-group">
              <label>URL</label>
              <input v-model="form.url" type="text" class="form-control">
            </div>
          </div>

          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </form>
      </div>
    </div>

    <div class="col-sm-8">
      <div class="card">
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-striped">
              <tr>
                <th>id</th>
                <th>Gambar</th>
                <th>Target</th>
                <th>Action</th>
              </tr>

              <tr v-for="banner in banners">
                <td>{{banner.id}}</td>
                <td><img :src="banner.image" class="img-responsive m-1" height="100"></td>
                <td>
                  <span v-if="banner.voucher_id" class="badge badge-warning">Voucher</span>
                  <span v-else-if="banner.post_id" class="badge badge-primary">Post</span>
                  <span v-else-if="banner.url" class="badge badge-light">URL</span>
                </td>
                <td>
                  <button @click="edit(banner)" class="btn btn-icon btn-sm btn-info mr-1" ><i class="fa fa-edit"></i></button>
                  <button @click="remove(banner.id)" class="btn btn-icon btn-sm btn-danger" ><i class="fa fa-trash"></i></button>
                </td>
              </tr>
            </table>
          </div>
        </div>

        <div class="card-footer text-right">
          <nav class="d-inline-block">

          </nav>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Layout from '@/Shared/Admin/LayoutAdmin'
import { useForm } from '@inertiajs/inertia-vue3'
import 'izitoast/dist/css/iziToast.min.css'
import iziToast from 'izitoast'
import {Inertia} from "@inertiajs/inertia";

export default {
  layout: Layout,
  props: {
    vouchers: Object,
    posts: Object,
    banners: Object
  },
  setup () {
    const form = useForm({
      id: null,
      voucher_id: null,
      post_id: null,
      url: null,
      image: null,
    })

    let bannerId = null;

    function submit() {
      form.post('/admin/banners', {
        onSuccess: () => {
          iziToast.success({
            message: 'Banner berhasil disimpan!',
            position: 'bottomRight'
          });

          form.reset();
        }
      })
    }

    function remove(id) {
      Inertia.delete('/admin/banners/'+id, {
        preserveScroll: true,
        onSuccess: () => {
          iziToast.success({
            message: 'Banner berhasil dihapus!',
            position: 'bottomRight'
          });
        }
      });
    }

    function edit(banner) {
      bannerId = banner.id;
      form.id = banner.id;
      form.voucher_id = banner.voucher_id;
      form.post_id = banner.post_id;
      form.url = banner.url;
      form.image = banner.image;
    }

    return {
      form,
      submit,
      remove,
      edit
    }
  },
}
</script>