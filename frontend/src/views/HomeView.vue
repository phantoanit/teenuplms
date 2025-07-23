<script setup>
import TheWelcome from '../components/TheWelcome.vue'
import { reactive, ref, onMounted } from 'vue'
import api from '@/services/api'

const parent = reactive({
  name: '',
  phone: '',
  email: ''
})

const student = reactive({
  name: '',
  dob: '',
  gender: '',
  current_grade: '',
  parent_id: ''
})

const class_registrations = reactive({
  class_id: '',
  student_id: '',
  time_slot: ''
})

const timeList = ref([
  { id: 8, name: '8H'},
  { id: 9, name: '9H'},
  { id: 10, name: '10H'},
  { id: 14, name: '14H'},
  { id: 15, name: '15H'},
  { id: 16, name: '16H'}
])

const parentList = ref([])
const fetchParents = async () => {
  try {
    const response = await api.get('/api/parents') // API URL thực tế
    parentList.value = response.data
  } catch (error) {
    console.error('Lỗi khi tải danh sách phụ huynh:', error)
  }
}
const classList = ref([])
const fetchClassList = async () => {
  try {
    const response = await api.get('/api/classes') // API URL thực tế
    classList.value = response.data
  } catch (error) {
    console.error('Lỗi khi tải danh sách phụ huynh:', error)
  }
}
const studentList = ref([])
const fetchStudentList = async () => {
  try {
    const response = await api.get('/api/students') // API URL thực tế
    studentList.value = response.data
  } catch (error) {
    console.error('Lỗi khi tải danh sách phụ huynh:', error)
  }
}
const classAndDay = ref([]);
const fetchClassAndDay = (weekday) => {
  try {
    const response = api.get('/api/classes') // API URL thực tế
    classAndDay.value = response.data;
  } catch (error) {
    console.error('Lỗi khi tải danh sách phụ huynh:', error)
    return []
  }
}


onMounted(() => {
  fetchParents();
  fetchClassList();
  fetchStudentList();
})

const submitFormParent = () => {
  console.log('Dữ liệu gửi đi:', parent)
  api.post('/api/parents', parent)
  .then(res => {
    alert('Đã lưu thành công!');
    parent.name = null;
    parent.phone = null;
    parent.email = null;
    fetchParents();
  })
  .catch(err => console.error(err))
}

const submitFormStudent = () => {
  console.log('Dữ liệu gửi đi:', student)
  api.post('/api/students', student)
  .then(res => {
    alert('Đã lưu thành công!');
    student.name = null;
    student.dob = null;
    student.gender = null;
    student.current_grade = null;
    student.parent_id = null;
  })
  .catch(err => console.error(err))
}

const submitFormClassRegister = () => {
  console.log('Dữ liệu gửi đi:', student)
  api.post(`/api/classes/${class_registrations.class_id}/register`, class_registrations)
  .then(res => {
    alert('Đã lưu thành công!');
    class_registrations.class_id = null;
    class_registrations.student_id = null;
    class_registrations.time_slot = null;
  })
  .catch(err => console.error(err))
}
</script>

<template>
  <div class="max-w-3xl mx-auto p-6 bg-white shadow border rounded-lg space-y-8">
    <h2 class="text-xl font-semibold">Phần mềm LMS</h2>
  <!-- Parents Form -->
  <div>
    <h2 class="text-xl font-semibold mb-4">Thông tin Phụ huynh</h2>
    <form @submit.prevent="" class="space-y-8 max-w-3xl mx-auto p-6 bg-white shadow rounded-lg">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pd-2">
      <div>
        <label class="block text-sm font-medium text-gray-700">Họ tên</label>
        <input type="text" v-model="parent.name" name="parent_name" class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required />
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700">Số điện thoại</label>
        <input type="text" v-model="parent.phone" name="parent_phone" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required />
      </div>
      <div class="md:col-span-2">
        <label class="block text-sm font-medium text-gray-700">Email</label>
        <input type="email" v-model="parent.email" name="parent_email" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required/>
      </div>
      
    </div>
    </form>
    <div class="text-right mt-6">
        <button @click="submitFormParent" class="bg-blue-600 text-white cursor-pointer px-6 py-2 rounded-md hover:bg-blue-700 transition">Lưu thông tin</button>
      </div>
  </div>

  <!-- Students Form -->
  <div class="mt-6">
    <h2 class="text-xl font-semibold mb-4">Thông tin Học sinh</h2>
    <form @submit.prevent="" class="space-y-8 max-w-3xl mx-auto p-6 bg-white shadow rounded-lg">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div>
        <label class="block text-sm font-medium text-gray-700">Họ tên</label>
        <input type="text"  v-model="student.name" name="student_name" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required />
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700">Ngày sinh</label>
        <input type="date" v-model="student.dob" name="dob" class="mt-1 block w-full border border-gray-300 rounded-md p-2" />
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700">Giới tính</label>
        <select name="gender" v-model="student.gender" class="mt-1 block w-full border border-gray-300 rounded-md p-2">
          <option value="" disabled>-- Chọn giới tính --</option>
          <option value="1">Nam</option>
          <option value="0">Nữ</option>
          <option value="2">Khác</option>
        </select>
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700">Khối lớp hiện tại</label>
        <input type="text" v-model="student.current_grade" name="current_grade" class="mt-1 block w-full border border-gray-300 rounded-md p-2" />
      </div>
      <div class="md:col-span-2">
        <label class="block text-sm font-medium text-gray-700">Chọn Phụ huynh</label>
        <select name="parent_id" v-model="student.parent_id" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
          <option value="">-- Chọn phụ huynh --</option>
          <!-- Giả sử bạn render danh sách từ backend -->
          <option v-for="p in parentList" :key="p.id" :value="p.id">{{ p.name }}</option>
        </select>
      </div>
    </div>
    <!-- Submit -->
    <div class="text-right">
      <button @click="submitFormStudent" class="bg-blue-600 text-white cursor-pointer px-6 py-2 rounded-md hover:bg-blue-700 transition">Lưu thông tin</button>
    </div>
    </form>
  </div>

  <!-- Students Form -->
  <div class="mt-6">
    <h2 class="text-xl font-semibold mb-4">Đăng ký lớp học cho học sinh</h2>
    <form @submit.prevent="" class="space-y-8 max-w-3xl mx-auto p-6 bg-white shadow rounded-lg">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div>
        <label class="block text-sm font-medium text-gray-700">Khung giờ đăng ký</label>
        <select name="gender" v-model="class_registrations.time_slot" class="mt-1 block w-full border border-gray-300 rounded-md p-2">
          <option value="" disabled>-- Chọn giờ học --</option>
          <option v-for="p in timeList" :key="p.id" :value="p.id">{{ p.name }}</option>
        </select>
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700">Học sinh</label>
        <select name="gender" v-model="class_registrations.student_id" class="mt-1 block w-full border border-gray-300 rounded-md p-2">
          <option value="" disabled>-- Chọn học sinh --</option>
          <option v-for="p in studentList" :key="p.id" :value="p.id">{{ p.name }}</option>
        </select>
      </div>
      <div class="md:col-span-2">
        <label class="block text-sm font-medium text-gray-700">Chọn lớp học</label>
        <select name="parent_id" v-model="class_registrations.class_id" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
          <option value="">-- Chọn lớp --</option>
          <!-- Giả sử bạn render danh sách từ backend -->
          <option v-for="p in classList" :key="p.id" :value="p.id">{{ p.name }}</option>
        </select>
      </div>
    </div>
    <!-- Submit -->
    <div class="text-right">
      <button @click="submitFormClassRegister" class="bg-blue-600 text-white cursor-pointer px-6 py-2 rounded-md hover:bg-blue-700 transition">Lưu thông tin</button>
    </div>
    </form>
  </div>

  <div class="overflow-x-auto">
    <h2 class="text-xl font-semibold mb-4">Danh sách lớp học trong tuần này</h2>
  <table class="min-w-full divide-y divide-gray-200 border border-gray-300 rounded-lg">
    <thead class="bg-gray-100">
      <tr>
        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Name</th>
        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Time Slot</th>
        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Teacher</th>
      </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
      <!-- 7 rows for 7 days -->
      <tr v-for="(day, index) in classList" :key="index">
        <td class="px-4 py-2 text-sm text-gray-800">{{ day.name }}</td>
        <td class="px-4 py-2 text-sm text-gray-800">{{ day.time_slot }}</td>
        <td class="px-4 py-2 text-sm text-gray-800">{{ day.teacher_name }}</td>
      </tr>
    </tbody>
  </table>
</div>

</div>
</template>

