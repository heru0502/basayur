<template>
  <div class="row">
    <div class="col-sm-5">
      <div class="card">

        <div class="card-body">
          <div class="invoice mb-0 p-0">
            <div class="invoice-title">
              <h2>&nbsp</h2>
              <div class="invoice-number">#{{orderSelected.order_number}}</div>
            </div>
            <hr class="my-2">

            <div class="row">
              <div class="col-6">
                <p>
                  <strong>Tanggal Pesan</strong><br>
                  {{orderSelected.created_at_string}}
                </p>

                <p>
                  <strong>Waktu Pengiriman</strong><br>
                  {{orderSelected.delivery_date}} ~ 08.00 - 10.00
                </p>
              </div>

              <div class="col-6 text-right">
                <p>
                  <strong>Metode Pembayaran</strong><br>
                  COD
                </p>

                <p>
                  <strong>Total Tagihan</strong><br>
                  Rp {{orderSelected.grand_total}}
                </p>
              </div>
            </div>

            <h5 class="mt-3">Ringkasan Belanja</h5>

            <div class="row" v-if="orderSelected">
              <div class="col-12">
                <div v-for="item in orderSelected.items" class="d-flex mb-2">
                  <div>
                    <img :src="item.menu.image" width="60">
                  </div>
                  <div class="ml-3 flex-fill">
                    <h5 class="mt-0">{{item.menu.name}}</h5>
                    <div class="row">
                      <div class="col ml-0">
                        <span class="text-warning font-weight-bold">Rp {{item.selling_price}}</span>
                        <span class="text-black"> / {{item.size_per_unit}} {{item.unit.name}}</span>
                      </div>
                      <div class="col-auto">
                        <p>x{{item.qty}}</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col">
                Subtotal<br>
                Biaya Pengiriman<br>
                Total
              </div>
              <div class="col text-right">
                Rp {{orderSelected.subtotal}}<br>
                Rp {{orderSelected.delivery_price}}<br>
                <strong>Rp {{orderSelected.grand_total}}</strong>
              </div>
            </div>

            <h5 class="mt-4">Alamat Pengiriman</h5>

            <div class="row">
              <div class="col-12">
                <p>
                  <strong>{{orderSelected ? orderSelected.customer.name : ''}}</strong><br>
                  No. HP ({{orderSelected ? orderSelected.address.phone_number : ''}})<br>
                  {{orderSelected ? orderSelected.address.address : ''}}
                </p>

                <a :href="'https://maps.google.com/?q='+ orderSelected.address.location_point" target="_blank" class="btn btn-primary"><i class="fa fa-map"></i> Lihat Peta</a>
              </div>
            </div>

            <h5 class="mt-5">Progress</h5>

            <div class="row bg-light py-3">
              <div class="col-12">
                <div class="activities">
                  <div class="activity" v-for="status in orderSelected.progress_status">
                    <div :class="'activity-icon '+ progressStatusColor(status.color) +' text-white shadow-primary'">
                      <i :class="status.icon"></i>
                    </div>
                    <div class="activity-detail">
                      <div class="mb-2">
                        <span class="text-job text-primary">2 min ago</span>
                        <span class="bullet"></span>
                        <a class="text-job" href="#">View</a>
                        <div class="float-right dropdown">
                          <a href="#" data-toggle="dropdown"><i class="fas fa-ellipsis-h"></i></a>
                          <div class="dropdown-menu">
                            <div class="dropdown-title">Options</div>
                            <a href="#" class="dropdown-item has-icon"><i class="fas fa-eye"></i> View</a>
                            <a href="#" class="dropdown-item has-icon"><i class="fas fa-list"></i> Detail</a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item has-icon text-danger" data-confirm="Wait, wait, wait...|This action can't be undone. Want to take risks?" data-confirm-text-yes="Yes, IDC"><i class="fas fa-trash-alt"></i> Archive</a>
                          </div>
                        </div>
                      </div>
                      <p>Have commented on the task of "<a href="#">Responsive design</a>".</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="card-footer">
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </div>
    </div>

    <div class="col-sm-7">
      <div class="card">
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table table-striped">
              <tr>
                <th>Nomor Order</th>
                <th>Nama Customer</th>
                <th>Grand Total</th>
                <th>Status</th>
                <th>Action</th>
              </tr>

              <tr v-for="order in orders" :class="rowSelected === order.id ? 'bg-light' : ''">
                <td>{{order.order_number}}</td>
                <td>{{order.customer.name}}</td>
                <td>{{order.grand_total}}</td>
                <td>
                  <span :class="'badge '+ statusColor(order.status_order_id)">
                    {{order.status_order.name}}
                  </span>
                </td>
                <td>
                  <button @click="show(order)"  class="btn btn-icon btn-sm btn-primary mr-1" ><i class="fa fa-eye"></i></button>
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
  components: {

  },
  props: {
    orders: Object
  },
  setup () {

    function statusColor(statusOrderId) {
      if (statusOrderId === 1) {
        return 'badge-info'
      }

      if (statusOrderId === 2) {
        return 'badge-warning'
      }

      if (statusOrderId === 3) {
        return 'badge-danger'
      }

      if (statusOrderId === 4) {
        return 'badge-success'
      }
    }

    return {
      statusColor
    }
  },
  mounted() {

  },
  data() {
    return {
      orderSelected: {
        address: {},
        customer: {}
      },
      rowSelected: ''
    }
  },
  methods: {
    show(order) {
      this.rowSelected = order.id;
      this.orderSelected = order;
    },
    progressStatusColor(bgColor) {
      if (bgColor === 'bg-white') {
        return 'bg-light';
      }

      if (bgColor === 'bg-green-light') {
        return 'bg-success';
      }

      if (bgColor === 'bg-yellow-light') {
        return 'bg-warning';
      }

      if (bgColor === 'bg-red-light') {
        return 'bg-danger';
      }
    }
  }
}
</script>
