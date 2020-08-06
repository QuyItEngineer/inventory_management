<template>
    <div>
        <div class="col-md-12">
            <div data-repeater-list="orders" v-for="(item, index) in items">
                <div data-repeater-item class="mt-repeater-item row">
                    <div class="mt-repeater-input col-md-5 col-12">
                        <label class="control-label">Sản phẩm: <span class="required"> * </span></label>
                        <select class="form-control" id="products" :name="getProductName('unique_code',index)" v-model="item.unique_code">
                            <option v-for="(value, key) in products" :key="key" :value="value.unique_code">{{value.name}}</option>
                        </select>
                    </div>
                    <div class="mt-repeater-input col-md-5 col-12" v-if="item.unique_code !== ''">
                        <label class="control-label">Số lượng: <span class="required"> * </span></label>
                        <input type="number" class="form-control" v-model="item.quantity"
                               :name="getProductName('quantity',index)"
                               @input="checkQuantity(item.unique_code, item.quantity)" required>
                        <span :id="'error_quantity_' + item.unique_code" style="color: red; display: none" >Số lượng không đủ</span>
                    </div>
                    <div class="mt-repeater-input col-md-5 col-12" v-else>
                        <label class="control-label">Số lượng: <span class="required"> * </span></label>
                        <input type="number" class="form-control" v-model="item.quantity" @input="checkQuantity(item.unique_code, item.quantity)" required readonly>
                    </div>

                    <div class="mt-repeater-input col-md-2 col-12">
                        <label class="control-label">&nbsp;</label>
                        <a href="javascript:;" data-repeater-delete @click="deleteProduct(index)" class="btn btn-block btn-danger mt-repeater-delete">
                            <i class="fa fa-close"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="row">
                <div class="col-md-10"></div>
                <div class="col-md-2">
                    <label class="control-label">&nbsp;</label>
                    <a href="javascript:;" id="close-form" @click="addNewProduct" data-repeater-create
                       class="btn btn-block btn-success mt-repeater-add"><i class="fa fa-plus"></i> ADD </a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "AddProductInOrder",
        props: {
            products : {
                type : Object,
            },
        },
        data() {
            return {
                items: [{
                    name: '',
                    unique_code: '',
                    quantity: '',
                }],
            }
        },
        methods: {
            addNewProduct() {
                this.items.push({
                    name: '',
                    unique_code: '',
                    quantity: 0,
                })
            },
            deleteProduct(index) {
                this.items.splice(index, 1);
            },
            getProductName(fieldName, index) {
                return `products[${index}][${fieldName}]`;
            },
            checkQuantity(key, param) {
                let products = {
                    'unique_code' : key,
                    'quantity' : Number(param)
                }
                axios.post('/api/products/check-quantity', products)
                    .then((res) => {
                        if (res.data.data === false) {
                            document.getElementById('error_quantity_' + res.data.unique_code).style.display = 'block'
                        } else {
                            document.getElementById('error_quantity_' + res.data.unique_code).style.display = 'none'
                        }
                    })
                    .catch((err) => {
                        console.log('fail function required')
                    });
            }
        },
    }
</script>

<style scoped>
    .required {
        color: #e02222;
        font-size: 12px;
        padding-left: 2px;
    }
</style>
