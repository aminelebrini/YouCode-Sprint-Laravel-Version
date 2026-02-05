<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Étudiant | YouCode Sprint</title>
    <style>
        @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        .animate-fade-in { animation: fadeInUp 0.6s ease-out forwards; }
        .glass-card { background: rgba(5, 5, 5, 0.8); backdrop-filter: blur(16px); border: 1px solid rgba(34, 211, 238, 0.2); }
        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-track { background: #050505; }
        ::-webkit-scrollbar-thumb { background: #22d3ee; border-radius: 10px; }
        .no-bubble { pointer-events: auto; }
    </style>
</head>
<body class="bg-cyan-900 bg-cover bg-center bg-no-repeat min-h-screen font-sans text-white overflow-hidden">

    <div class="flex h-screen overflow-hidden">
        
        <aside class="w-72 glass-card m-4 rounded-[2rem] hidden md:flex flex-col p-6 animate-fade-in">
            <header class="text-center mb-12">
                <h1 class="text-white text-2xl font-black italic uppercase tracking-tighter">
                    Learner <br>
                    <span class="text-cyan-400 inline-block">Dashboard</span>
                </h1>
                <div class="h-[2px] w-[40%] bg-cyan-500 mx-auto mt-2 rounded-full shadow-[0_0_10px_#22d3ee]"></div>
            </header>

            <nav class="flex-1 space-y-3">
                <a href="#" class="flex items-center space-x-4 text-cyan-400 bg-white/5 px-6 py-4 rounded-2xl font-black uppercase tracking-widest text-xs transition-all">
                    <i class="fas fa-terminal"></i>
                    <span>Mon Dashboard</span>
                </a>
            </nav>

            <div class="mt-auto pt-6 border-t border-white/5">
                <a href="/logout" class="w-full flex items-center space-x-4 text-red-400/60 hover:text-red-400 px-6 py-4 rounded-2xl font-black uppercase tracking-widest text-xs transition-all">
                    <i class="fas fa-power-off"></i>
                    <span>Déconnexion</span>
                </a>
            </div>
        </aside>

        <main class="flex-1 p-4 md:p-8 overflow-y-auto">
            
            <div class="glass-card rounded-[1.5rem] p-4 mb-8 flex justify-between items-center px-8 animate-fade-in">
                <div class="flex flex-col">
                    <span class="text-[10px] text-cyan-400 font-black uppercase tracking-[0.3em]">Promotion Active</span>
                    @if($etudiants && $etudiants->classe)
                        <h2 class="text-white font-black uppercase tracking-widest text-sm italic">
                            {{ $etudiants->classe->nom }}
                        </h2>
                    @else
                        <h2 class="text-white/40 font-black uppercase tracking-widest text-sm italic">Aucune classe</h2>
                    @endif
                </div>
                <div class="flex items-center space-x-4 border-l border-white/10 pl-6">
                    <div class="text-right">
                        <p class="text-xs font-black text-white uppercase italic">{{ auth()->user()->firstname }} {{ auth()->user()->lastname }}</p>
                        <p class="text-[10px] text-white/40 uppercase font-bold tracking-widest">Etudiant</p>
                    </div>
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-cyan-400 to-blue-600 p-0.5 shadow-[0_0_15px_rgba(34,211,238,0.3)]">
                        <img src="https://ui-avatars.com/api/?name={{ auth()->user()->firstname }}+{{ auth()->user()->lastname }}&background=000&color=fff" class="rounded-lg" alt="avatar">
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8 animate-fade-in">
                <div class="glass-card p-6 rounded-[2rem] border-l-4 border-l-cyan-400">
                    <p class="text-white/40 text-[9px] uppercase font-black tracking-widest mb-1">Briefs Reçus</p>
                    <h3 class="text-2xl font-black italic">{{ $briefs->count() }}</h3>
                </div>
                <div class="glass-card p-6 rounded-[2rem] border-l-4 border-l-yellow-500">
                    <p class="text-white/40 text-[9px] uppercase font-black tracking-widest mb-1">En cours</p>
                    <h3 class="text-2xl font-black italic">--</h3>
                </div>
                <div class="glass-card p-6 rounded-[2rem] border-l-4 border-l-green-500">
                    <p class="text-white/40 text-[9px] uppercase font-black tracking-widest mb-1">Validés</p>
                    <h3 class="text-2xl font-black italic">--</h3>
                </div>
            </div>

            <section class="mb-8 animate-fade-in">
                <div class="mb-6 px-4">
                    <h2 class="text-cyan-400 font-black uppercase tracking-[0.3em] text-lg italic"><i class="fas fa-bolt mr-3"></i>Tes Briefs Actuels</h2>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">     
                    @forelse($briefs as $brief)
                        <div onclick="OpenModal(this)" 
                            data-titre="{{ $brief->nom }}" 
                            data-description="{{ $brief->description }}" 
                            data-type="{{ $brief->type }}" 
                            data-debut="{{ $brief->date_debut }}" 
                            data-fin="{{ $brief->date_fin }}"
                            class="glass-card p-8 rounded-[2.5rem] group hover:border-cyan-400/50 transition-all duration-500 relative flex flex-col justify-between cursor-pointer">
                            
                            <div class="absolute top-0 right-0 p-6 text-[8px] font-black uppercase tracking-widest text-green-400 bg-green-500/10 rounded-bl-2xl border-l border-b border-green-500/20">Actif</div>
                            
                            <div>
                                <h4 class="text-xl font-black text-white uppercase mb-3 group-hover:text-cyan-400 transition-colors italic">{{ $brief->nom }}</h4>
                                <div class="space-y-2 text-[11px] text-white/70 mb-6">
                                    <p><span class="text-cyan-400 font-bold uppercase">Tech:</span> {{ $brief->type }}</p>
                                    <p><span class="text-cyan-400 font-bold uppercase">Deadline:</span> <span class="text-red-400 font-black">{{ $brief->date_fin }}</span></p>
                                </div>
                            </div>

                            <div class="border-t border-white/5 pt-6">
                                <button onclick="event.stopPropagation(); openRenduModal('{{ $brief->id }}', '{{ addslashes($brief->nom) }}')" 
                                        class="no-bubble w-full bg-white text-black font-black py-4 rounded-xl uppercase tracking-widest text-[10px] hover:bg-cyan-400 transition-all">
                                    <i class="fas fa-cloud-upload-alt mr-2"></i> Soumettre mon rendu
                                </button>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-2 text-center py-10 text-white/20 italic">Aucun brief disponible.</div>
                    @endforelse
                </div>
            </section>

            <section class="mt-12 mb-8 animate-fade-in">
    <div class="mb-6 px-4">
        <h2 class="text-cyan-400 font-black uppercase tracking-[0.3em] text-lg italic">
            <i class="fas fa-clipboard-check mr-3"></i>Mes Corrections
        </h2>
    </div>

    <div class="glass-card rounded-[2.5rem] overflow-hidden border border-white/5 shadow-2xl">
        <div class="overflow-x-auto shadow-[inset_0_0_20px_rgba(34,211,238,0.05)]">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="text-cyan-400/60 text-[10px] uppercase tracking-[0.2em] border-b border-white/5 bg-white/[0.02]">
                        <th class="p-6 font-black italic">Brief</th>
                        <th class="p-6 font-black italic">Compétence</th>
                        <th class="p-6 font-black italic">Maîtrise</th>
                        <th class="p-6 font-black italic">Feedback</th>
                        <th class="p-6 font-black italic text-right">Date</th>
                    </tr>
                </thead>
                <tbody class="text-white/80 divide-y divide-white/5">
                    @forelse($corrections as $correction)
                    <tr class="hover:bg-cyan-400/[0.03] transition-colors group">
                        <td class="p-6">
                            <div class="flex flex-col">
                                <span class="font-black text-xs uppercase italic text-white group-hover:text-cyan-400 transition-colors">
                                    {{ $correction->brief->nom ?? '-' }}
                                </span>
                                <span class="text-[9px] text-white/30 uppercase tracking-widest mt-1">
                                    {{ $correction->formateur->username ?? 'Formateur' }}
                                </span>
                            </div>
                        </td>
                        <td class="p-6">
                            <span class="bg-white/5 px-3 py-1.5 rounded-xl text-[9px] font-bold border border-white/10 uppercase italic text-cyan-400/80">
                                {{ $correction->competence->nom ?? '-' }}
                            </span>
                        </td>
                        <td class="p-6">
                            @php
                                $statusClasses = [
                                    'TRANSPOSER' => 'bg-green-500/10 text-green-400 border-green-500/20',
                                    'ADAPTER' => 'bg-yellow-500/10 text-yellow-400 border-yellow-500/20',
                                    'IMITER' => 'bg-cyan-500/10 text-cyan-400 border-cyan-500/20'
                                ];
                                $currentClass = $statusClasses[$correction->niveau_maitrise] ?? 'bg-white/5 text-white/40 border-white/10';
                            @endphp
                            <span class="px-3 py-1 rounded-lg text-[9px] font-black uppercase tracking-widest border {{ $currentClass }}">
                                {{ $correction->niveau_maitrise }}
                            </span>
                        </td>
                        <td class="p-6">
                            <p class="text-[11px] leading-relaxed italic text-white/60 max-w-xs line-clamp-2 hover:line-clamp-none transition-all cursor-help">
                                "{{ $correction->commentaire }}"
                            </p>
                        </td>
                        <td class="p-6 text-right">
                            <span class="text-[10px] font-black text-white/40 uppercase italic">
                                {{ $correction->created_at->format('d/m/Y') }}
                            </span>
                            <div class="text-[8px] text-cyan-400/30 font-bold tracking-tighter uppercase">
                                {{ $correction->created_at->format('H:i') }}
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="p-12 text-center">
                            <div class="flex flex-col items-center gap-4 opacity-20">
                                <i class="fas fa-folder-open text-4xl text-cyan-400"></i>
                                <p class="uppercase tracking-[0.4em] text-[10px] font-black italic">Aucune évaluation pour le moment</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</section>
        </main>
    </div>
    <div id="RenduModal" class="hidden fixed inset-0 bg-black/90 backdrop-blur-md z-[70] flex items-center justify-center p-4">
        <div class="glass-card w-full max-w-lg p-10 rounded-[2.5rem] border border-cyan-400/30 animate-fade-in">
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h3 class="text-white text-2xl font-black italic uppercase">Soumettre <span class="text-cyan-400">Projet</span></h3>
                    <p id="modalBriefName" class="text-cyan-400/40 text-[9px] font-black uppercase mt-1 italic tracking-widest"></p>
                </div>
                <button onclick="toggleModal('RenduModal')" class="text-white/20 hover:text-white"><i class="fas fa-times text-xl"></i></button>
            </div>
            
            <form action="{{ route('etudiant.rendu') }}" method="POST" class="space-y-6">
                @csrf
                <input type="hidden" name="brief_id" id="rendu_brief_id">
                <input type="hidden" name="etudiant_id" value="{{ auth()->user()->id }}">
               
                <div class="space-y-2">
                    <label class="text-cyan-400/60 text-[9px] font-black uppercase tracking-widest ml-2 italic block text-left">Titre du Projet</label>
                    <div class="relative">
                        <i class="fab fa-title absolute left-5 top-1/2 -translate-y-1/2 text-white/20"></i>
                        <input type="text" name="Titrerendu" required placeholder="Simplon" 
                            class="w-full bg-white/5 border border-white/10 rounded-2xl py-5 pl-14 pr-5 text-white outline-none focus:border-cyan-400/50 transition-all">
                    </div>
                </div>
                <div class="space-y-2">
                    <label class="text-cyan-400/60 text-[9px] font-black uppercase tracking-widest ml-2 italic block text-left">Lien du Repository (GitHub / Vercel)</label>
                    <div class="relative">
                        <i class="fab fa-github absolute left-5 top-1/2 -translate-y-1/2 text-white/20"></i>
                        <input type="url" name="lien_rendu" required placeholder="https://github.com/..." 
                               class="w-full bg-white/5 border border-white/10 rounded-2xl py-5 pl-14 pr-5 text-white outline-none focus:border-cyan-400/50 transition-all">
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-cyan-400/60 text-[9px] font-black uppercase tracking-widest ml-2 italic block text-left">Message au Formateur</label>
                    <textarea name="commentaire" rows="3" class="w-full bg-white/5 border border-white/10 rounded-2xl py-4 px-5 text-white outline-none focus:border-cyan-400/50 transition-all" placeholder="Une précision ?"></textarea>
                </div>

                <button type="submit" class="w-full bg-white text-black font-black py-5 rounded-2xl uppercase tracking-[0.3em] text-xs hover:bg-cyan-400 transition-all duration-500">
                    Confirmer l'envoi
                </button>
            </form>
        </div>
    </div>
    
    <div id="ContenuModal" class="hidden fixed inset-0 bg-black/95 backdrop-blur-xl z-[60] flex items-center justify-center p-4">
        <div class="glass-card w-full max-w-4xl rounded-[3rem] border-cyan-400/30 animate-fade-in flex flex-col max-h-[90vh] overflow-hidden">
            <div class="p-8 border-b border-white/5 flex justify-between items-center bg-white/[0.02]">
                <h3 id="modalTitle" class="text-2xl font-black italic uppercase text-cyan-400"></h3>
                
                <button onclick="toggleModal('ContenuModal')" class="w-12 h-12 rounded-2xl bg-white/5 flex items-center justify-center text-white/40 hover:text-white hover:bg-red-500/20 transition-all border border-white/5">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <div class="p-8 md:p-12 overflow-y-auto space-y-10 text-left">
                <div class="space-y-4">
                    <h4 class="text-cyan-400 text-xs font-black uppercase tracking-[0.4em] flex items-center gap-3 italic">
                        <i class="fas fa-terminal"></i> Description du Projet
                    </h4>
                    <div id="modalBriefDesc" class="text-white/70 text-sm md:text-base leading-[2] font-medium italic bg-white/[0.01] p-6 rounded-3xl border border-white/5 whitespace-pre-line"></div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-4">
                        <h4 class="text-cyan-400 text-xs font-black uppercase tracking-[0.4em] italic"><i class="fas fa-code mr-2"></i> Technologies</h4>
                        <div id="modalBriefTech" class="text-white font-bold uppercase tracking-widest text-xs bg-white/5 p-4 rounded-2xl border border-white/5"></div>
                    </div>
                    <div class="space-y-4">
                        <h4 class="text-cyan-400 text-xs font-black uppercase tracking-[0.4em] italic"><i class="fas fa-medal mr-2"></i> Compétences visées</h4>
                        <div id="modalBriefComp" class="text-white font-bold uppercase tracking-widest text-xs bg-white/5 p-4 rounded-2xl border border-white/5"></div>
                    </div>
                    <div class="space-y-4">
                        <h4 class="text-green-400 text-xs font-black uppercase tracking-[0.4em] italic"><i class="fas fa-calendar-check mr-2"></i> Lancement</h4>
                        <p id="modaldatedebut" class="text-xl font-black italic text-white uppercase tracking-widest bg-green-500/5 p-4 rounded-2xl border border-green-500/10 text-center"></p>
                    </div>
                    <div class="space-y-4">
                        <h4 class="text-red-400 text-xs font-black uppercase tracking-[0.4em] italic"><i class="fas fa-calendar-times mr-2"></i> Livraison</h4>
                        <p id="modaldatefin" class="text-xl font-black italic text-white uppercase tracking-widest bg-red-500/5 p-4 rounded-2xl border border-red-500/10 text-center"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleModal(id) {
            document.getElementById(id).classList.toggle('hidden');
        }

        function OpenModal(element) {
            document.getElementById('modalTitle').innerText = element.getAttribute('data-titre');
            document.getElementById('modalBriefDesc').innerText = element.getAttribute('data-description');
            document.getElementById('modalBriefTech').innerText = element.getAttribute('data-type');
            document.getElementById('modalBriefComp').innerText = element.getAttribute('data-competence') || 'Générale';
            document.getElementById('modaldatedebut').innerText = element.getAttribute('data-debut');
            document.getElementById('modaldatefin').innerText = element.getAttribute('data-fin');
            toggleModal('ContenuModal');
        }

        function openRenduModal(id, title) {
            document.getElementById('rendu_brief_id').value = id;
            document.getElementById('modalBriefName').innerText = title;
            toggleModal('RenduModal');
        }
    </script>
</body>
</html>