<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
          {{-- {{ __('Dashboard')__ }} --}}
      </h2>
  </x-slot>
  <div class="p-4">
      <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
          <div class="grid grid-cols-3 gap-4 mb-4">
              <div class="flex items-center justify-center h-24 rounded bg-red-500 dark:bg-slate-800">
                  <p class="text-white dark:text-gray-500">
                      Nombre de Patients : {{ $patientsCount }}
                  </p>
              </div>
              <div class="flex items-center justify-center h-24 rounded bg-red-500 dark:bg-gray-800">
                  <p class="text-white dark:text-gray-500">
                      Hospitalisés : {{ $hospitalisationsCount }}
                  </p>
              </div>
              <div class="flex items-center justify-center h-24 rounded bg-red-500 dark:bg-gray-800">
                  <p class="text-white dark:text-gray-500">
                      Non Hospitalisés : {{ $nonHospitalisesCount }}
                  </p>
              </div>
          </div>
          <div class="grid grid-cols-2 gap-4 mb-4">
              <div class="flex items-center justify-center rounded bg-gray-50 h-56 dark:bg-gray-800">
                  <canvas id="barChart" class="w-full h-full"></canvas>
              </div>
              <div class="flex items-center justify-center rounded bg-gray-50 h-56 dark:bg-gray-800">
                  <canvas id="pieChart" class="w-full h-full"></canvas>
              </div>
          </div>
          <div class="flex items-center justify-center h-48 mb-4 rounded bg-gray-50 dark:bg-gray-800">
              <div>
                  <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">
                      Les nouveaux patients :
                  </h3>
                  <ul>
                      @forelse($newPatients as $newPatient)
                          <li class="text-gray-700 dark:text-gray-300">
                              {{ $newPatient->name }}
                          </li>
                      @empty
                          <li class="text-gray-700 dark:text-gray-300">Aucun nouveau patient.</li>
                      @endforelse
                  </ul>
              </div>
          </div>
      </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <script>
      document.addEventListener("DOMContentLoaded", function () {
          const barChartCtx = document.getElementById('barChart').getContext('2d');
          const pieChartCtx = document.getElementById('pieChart').getContext('2d');
  
          new Chart(barChartCtx, {
              type: 'bar',
              data: {
                  labels: ['Hospitalisés', 'Non Hospitalisés'],
                  datasets: [{
                      label: 'Patients',
                      data: [{{ $hospitalisationsCount ?? 0 }}, {{ $nonHospitalisesCount ?? 0 }}],
                      backgroundColor: ['#f87171', '#60a5fa'],
                  }]
              }
          });
  
          new Chart(pieChartCtx, {
              type: 'pie',
              data: {
                  labels: ['Hospitalisés', 'Non Hospitalisés'],
                  datasets: [{
                      label: 'Patients',
                      data: [{{ $hospitalisationsCount ?? 0 }}, {{ $nonHospitalisesCount ?? 0 }}],
                      backgroundColor: ['#f87171', '#60a5fa'],
                  }]
              }
          });
      });
  </script>
  
</x-app-layout>
