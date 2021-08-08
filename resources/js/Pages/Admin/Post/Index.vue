<template>
  <div class="row">
    <div class="col-sm-7">
      <div class="card">

        <form @submit.prevent="submit">
          <div class="card-body">
            <div class="form-group">
              <label>Judul</label>
              <input v-model="form.title" type="text" class="form-control">
            </div>

            <div class="form-group">
              <label>Isi</label>
              <ckeditor v-model="form.post_content" :editor="editor"></ckeditor>
            </div>
          </div>

          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </form>
      </div>
    </div>

    <div class="col-sm-5">
      <div class="card">
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-striped">
              <tr>
                <th>id</th>
                <th>Judul</th>
                <th>Action</th>
              </tr>

              <tr v-for="post in posts">
                <td>{{post.id}}</td>
                <td>{{post.title}}</td>
                <td>
                  <button @click="edit(post)" class="btn btn-icon btn-sm btn-info mr-1" ><i class="fa fa-edit"></i></button>
                  <button @click="remove(post.id)" class="btn btn-icon btn-sm btn-danger" ><i class="fa fa-trash"></i></button>
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
import CKEditor from '@ckeditor/ckeditor5-vue';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

export default {
  layout: Layout,
  components: {
    ckeditor: CKEditor.component
  },
  props: {
    posts: Object
  },
  setup () {
    let editor = ClassicEditor;

    const form = useForm({
      id: null,
      title: null,
      post_content: ''
    });

    function submit() {
      form.post('/admin/posts', {
        preserveScroll: true,
        onSuccess: () => {
          iziToast.success({
            message: 'Postingan berhasil disimpan!',
            position: 'bottomRight'
          });

          form.reset();
        }
      })
    }

    function remove(id) {
      Inertia.delete('/admin/posts/'+id, {
        preserveScroll: true,
        onSuccess: () => {
          iziToast.success({
            message: 'Postingan berhasil dihapus!',
            position: 'bottomRight'
          });
        }
      });
    }

    function edit(post) {
      form.id = post.id;
      form.title = post.title;
      form.post_content = post.post_content;
    }

    return {
      editor,
      form,
      submit,
      remove,
      edit
    }
  },
}
</script>

<style>
.ck-editor__editable_inline {
  min-height: 500px;
}
</style>