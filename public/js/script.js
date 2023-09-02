let sidebar = document.querySelector('#sidebar')

function toggleSidebar() {
  if (sidebar.classList.contains('hidden')) {
    sidebar.classList.remove('hidden')
  } else {
    sidebar.classList.add('hidden')
  }
}

function driverOptions() {
  let el = document.querySelector('#driverOptions')
  if (el.classList.contains('hidden')) {
    el.classList.remove('hidden')
    getDrivers('', '.drivers');
  } else {
    el.classList.add('hidden')
  }
}

function choiceDriver(id, text) {
  document.querySelector('#driver_select span').innerHTML = text
  document.querySelector('#driver_id').value = id
  driverOptions()
}

async function getDrivers(name = '', selector) {
  let response = await fetch(`/api/driver?name=${name}`)
  let result = await response.json()
  let el = document.querySelector(selector)
  let drivers = "";
  result.forEach(driver => {
    drivers += `<div class="px-3 py-2 [&:nth-child(even)]:bg-blue-100 [&:nth-child(odd)]:bg-blue-50 [&:nth-child(even)]:hover:bg-blue-200 [&:nth-child(odd)]:hover:bg-blue-200 flex justify-between hover:bg-blue-200 cursor-pointer" onclick="choiceDriver(${driver.id}, '${driver.fullname} - ${driver.phone}')">${driver.fullname} - ${driver.phone}</div>`;
  });
  el.innerHTML = drivers;
}



function vehicleOptions() {
  let el = document.querySelector('#vehicleOptions')
  if (el.classList.contains('hidden')) {
    el.classList.remove('hidden')
    getVehicles('', '.vehicles');
  } else {
    el.classList.add('hidden')
  }
}

function choicevehicle(id, text) {
  document.querySelector('#vehicle_select span').innerHTML = text
  document.querySelector('#vehicle_id').value = id
  vehicleOptions()
}

async function getVehicles(name = '', selector) {
  let response = await fetch(`/api/vehicle?plat=${name}`)
  let result = await response.json()
  let el = document.querySelector(selector)
  let vehicles = "";
  result.forEach(vehicle => {
    vehicles += `<div class="px-3 py-2 [&:nth-child(even)]:bg-blue-100 [&:nth-child(odd)]:bg-blue-50 [&:nth-child(even)]:hover:bg-blue-200 [&:nth-child(odd)]:hover:bg-blue-200 flex justify-between hover:bg-blue-200 cursor-pointer" onclick="choicevehicle(${vehicle.id}, '${vehicle.plat} - ${(vehicle.transport_type == 'goods') ? 'Barang' : 'Penumpang'}')">${vehicle.plat} - ${(vehicle.transport_type == 'goods') ? 'Barang' : 'Penumpang'}</div>`;
  });
  el.innerHTML = vehicles;
}

let approvers = [];

function approverOptions(booking_id = null) {
  let el = document.querySelector('#approverOptions')
  let select = document.querySelector('#approver_select')
  if (el.classList.contains('hidden')) {
    if (booking_id != null) initApprover(booking_id)
    select.classList.remove('bg-gray-50')
    select.classList.add('bg-blue-500')
    select.classList.add('text-white')
    select.innerHTML = `<span>Selesai</span><i class="fa fa-angle-up"></i>`
    el.classList.remove('hidden')
    console.log(approvers)
    getApprovers('', '.approvers');
  } else {
    select.classList.add('bg-gray-50')
    select.classList.remove('bg-blue-500')
    select.classList.remove('text-white')
    select.innerHTML = `<span>Pilih Penyetujui</span><i class="fa fa-angle-down"></i>`
    el.classList.add('hidden')
    createApprovers()
  }
}

function submitBooking() {
  event.preventDefault();
  let el = document.querySelector('#approverOptions')
  let select = document.querySelector('#approver_select')
  if (!el.classList.contains('hidden')) {
    let el = document.querySelector('#approverOptions')
    let select = document.querySelector('#approver_select')
  
    select.classList.add('bg-gray-50')
    select.classList.remove('bg-blue-500')
    select.classList.remove('text-white')
    select.innerHTML = `<span>Pilih Penyetujui</span><i class="fa fa-angle-down"></i>`
    el.classList.add('hidden')
    createApprovers()
  }
  event.target.parentNode.submit()
}

async function initApprover(booking_id) {
  let response = await fetch(`/api/approver/${booking_id}`)
  let result = await response.json()

  if (approvers.length == 0) {
    result.forEach(v => {
      approvers.push({
        id: v.id, 
        text: `${v.fullname} - ${v.position}`
      })
    });
  }
}

function createApprovers() {
  let el = document.querySelector('#approvers')
  let text = ``;
  approvers.forEach(v => {
    text += `
    <input type="hidden" name="user_id[]" value="${v.id}">
    <div class="px-3 py-2 rounded border border-gray-400 w-full">${v.text}</div>
    `
  });
  el.innerHTML = text;
}

function choiceApprover(id, text, name) {
  let index = null;
  approvers.forEach((v, i) => {
    if (v.id == id) index = i
  })
  if (index === null) {
    approvers.push({
      id, text
    })
  } else {
    approvers.splice(index, 1);
  }
  getApprovers(name)
}

function isApproverChoiced(id) {
  let exists = false;
  approvers.forEach((v) => {
    if (v.id == id) exists = true
  })
  return exists
}

async function getApprovers(name = '') {
  let response = await fetch(`/api/approver?name=${name}`)
  let result = await response.json()
  let el = document.querySelector('.approvers')
  let approvers = "";
  result.forEach(approver => {
    if (isApproverChoiced(approver.id)) {
      approvers += `<div class="px-3 py-2 bg-blue-500 hover:bg-blue-600 text-white flex justify-between cursor-pointer" onclick="choiceApprover(${approver.id}, '${approver.fullname} - ${approver.position}', ${name})">${approver.fullname} - ${approver.position}</div>`;
    }else{
      approvers += `<div class="px-3 py-2 [&:nth-child(even)]:bg-blue-100 [&:nth-child(odd)]:bg-blue-50 [&:nth-child(even)]:hover:bg-blue-200 [&:nth-child(odd)]:hover:bg-blue-200 flex justify-between hover:bg-blue-200 cursor-pointer" onclick="choiceApprover(${approver.id}, '${approver.fullname} - ${approver.position}', ${name})">${approver.fullname} - ${approver.position}</div>`;
    }
  });
  el.innerHTML = approvers;
}