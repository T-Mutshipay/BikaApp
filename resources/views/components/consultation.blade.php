<!-- Main modal -->
<div id="modal-consultation" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full hidden">
    <div class="relative w-full h-full max-w-2xl md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow">
            <!-- Modal header -->
            <div class="flex items-start justify-between p-4 border-b rounded-t">
                <h3 class="text-xl font-semibold">
                    Créer une Consultation
                </h3>
                <button type="button" class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-hide="modal-consultation">
                    <span class="sr-only">Fermer</span>
                    &times;
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-6 space-y-6">
                <form id="consult_form" action="" method="POST">
                    @csrf
                    <div>
                        <div id="patient" class="text-xl font-semibold m-4 flex justify-center">
                            
                        </div>
                    </div>
                    <div class="flex space-x-4">
                        <div class="w-1/2">
                            <label for="motif_consultation" class="block mb-2 text-sm font-medium text-gray-900">Motif de Consultation</label>
                            <input type="text" id="motif_consultation" name="motif_consultation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                        </div>
                        <div class="w-1/2">
                            <label for="poids" class="block mb-2 text-sm font-medium text-gray-900">Poids (kg)</label>
                            <input type="number" id="poids" name="poids" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                        </div>
                    </div>
                    <div class="flex space-x-4">
                        <div class="w-1/2">
                            <label for="taille" class="block mb-2 text-sm font-medium text-gray-900">Taille (cm)</label>
                            <input type="number" id="taille" name="taille" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                        </div>
                        <div class="w-1/2">
                            <label for="temperature" class="block mb-2 text-sm font-medium text-gray-900">Température (°C)</label>
                            <input type="number" step="0.1" id="temperature" name="temperature" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                        </div>
                    </div>
                    <div class="flex space-x-4">
                        <div class="w-1/2">
                            <label for="tension" class="block mb-2 text-sm font-medium text-gray-900">Tension (mmHg)</label>
                            <input type="text" id="tension" name="tension" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                        </div>
                        <div class="w-1/2">
                            <label for="pouls" class="block mb-2 text-sm font-medium text-gray-900">Pouls (bpm)</label>
                            <input type="number" id="pouls" name="pouls" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                        </div>
                    </div>
                    {{-- <div>
                        <label for="date_consultation" class="block mb-2 text-sm font-medium text-gray-900">Date de Consultation</label>
                        <input type="date" id="date_consultation" name="date_consultation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                    </div> --}}
                    {{-- <div>
                        <label for="heure_consultation" class="block mb-2 text-sm font-medium text-gray-900">Heure de Consultation</label>
                        <input type="time" id="heure_consultation" name="heure_consultation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                    </div> --}}
                    <div class="w-full">
                        <label for="diagnostic" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">diagnostic</label>
                        <textarea id="diagnostic" name="diagnostic" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Votre diagnostic..."></textarea>
                    </div>
                    <div class="flex items-center p-6 border-t border-gray-200 rounded-b">
                        <button type="submit" class="text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-200 font-medium rounded-lg text-sm px-5 py-2.5 mr-2">Créer</button>
                        <button type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5" data-modal-hide="modal-consultation">Annuler</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
function consulter(event, button) {
    event.preventDefault();
    let nom_patient = button.getAttribute("data-message"); 
    let url = button.getAttribute("data-url");
    document.getElementById('patient').textContent= nom_patient;
    document.getElementById('consult_form').setAttribute("action",url);
    // alert(nom_patient);
}
</script>