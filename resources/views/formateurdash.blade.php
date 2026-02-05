<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>{{ $title }} | YouCode Sprint</title>
    <style>
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in { animation: fadeInUp 0.6s ease-out forwards; }

        .glass-card {
            background: rgba(5, 5, 5, 0.85);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(34, 211, 238, 0.2);
        }
        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-track { background: #050505; }
        ::-webkit-scrollbar-thumb { background: #22d3ee; border-radius: 10px; }
        
        /* Fix for select arrow in some browsers */
        select { background-image: none; }
    </style>
</head>
<body class="bg-cyan-950 bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-cyan-900 via-slate-950 to-black min-h-screen font-sans text-white overflow-hidden">

    <div class="flex h-screen overflow-hidden">

        <aside class="w-72 glass-card m-4 rounded-[2rem] hidden md:flex flex-col p-6 animate-fade-in shadow-2xl">
            <header class="text-center mb-12">
                <h1 class="text-white text-2xl font-black italic uppercase tracking-tighter">
                    Formateur <br>
                    <span class="text-cyan-400 inline-block">Dashboard</span>
                </h1>
                <div class="h-[2px] w-[40%] bg-cyan-500 mx-auto mt-2 rounded-full shadow-[0_0_10px_#22d3ee]"></div>
            </header>

            <nav class="flex-1 space-y-3">
                <a href="#" class="flex items-center space-x-4 text-cyan-400 bg-white/5 px-6 py-4 rounded-2xl font-black uppercase tracking-widest text-xs transition-all hover:bg-white/10">
                    <i class="fas fa-th-large"></i>
                    <span>Tableau de bord</span>
                </a>
                <a href="#" class="flex items-center space-x-4 text-white/60 hover:text-cyan-400 bg-white/5 px-6 py-4 rounded-2xl font-black uppercase tracking-widest text-xs transition-all hover:bg-white/10">
                    <i class="fas fa-file-code"></i>
                    <span>Mes Briefs</span>
                </a>
                <a href="#" class="flex items-center space-x-4 text-white/60 hover:text-cyan-400 bg-white/5 px-6 py-4 rounded-2xl font-black uppercase tracking-widest text-xs transition-all hover:bg-white/10">
                    <i class="fas fa-user-graduate"></i>
                    <span>Mes Etudiants</span>
                </a>
                <a href="#" class="flex items-center space-x-4 text-white/60 hover:text-cyan-400 bg-white/5 px-6 py-4 rounded-2xl font-black uppercase tracking-widest text-xs transition-all hover:bg-white/10">
                    <i class="fas fa-tasks"></i>
                    <span>Rendu</span>
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

            <div class="glass-card rounded-[1.5rem] p-4 mb-8 flex justify-between items-center px-8 animate-fade-in shadow-lg">
                <div class="flex flex-col">
                    <span class="text-[10px] text-cyan-400 font-black uppercase tracking-[0.3em]">Session Active</span>
                    @if($formateurs && $formateurs->classes->isNotEmpty())
                        @foreach($formateurs->classes as $classe)
                            <h2 class="text-lg font-black italic uppercase tracking-tight text-white">{{ $classe->nom }}</h2>
                        @endforeach
                    @else
                        <p class="text-xs text-white/50 italic">Aucune classe assignée.</p>
                    @endif
                </div>
                <div class="flex items-center space-x-4 border-l border-white/10 pl-6">
                    <div class="text-right">
                        <p class="text-[10px] text-white/40 uppercase font-bold tracking-widest">Formateur</p>
                        <p class="text-xs font-black text-white uppercase italic">{{ auth()->user()->firstname }} {{ auth()->user()->lastname }}</p>
                    </div>
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-cyan-400 to-blue-600 p-0.5 shadow-[0_0_15px_rgba(34,211,238,0.3)]">
                        <img src="https://ui-avatars.com/api/?name={{ auth()->user()->firstname }}+{{ auth()->user()->lastname }}&background=000&color=fff" class="rounded-lg" alt="avatar">
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8 animate-fade-in">
                <div class="glass-card p-6 rounded-[2rem] border-l-4 border-l-cyan-400">
                    <p class="text-white/40 text-[9px] uppercase font-black tracking-widest mb-1">Briefs Lancés</p>
                    <h3 class="text-2xl font-black italic text-white">{{ count($briefs) }}</h3>
                </div>
                <div class="glass-card p-6 rounded-[2rem] border-l-4 border-l-purple-500">
                    <p class="text-white/40 text-[9px] uppercase font-black tracking-widest mb-1">Apprenants</p>
                    <h3 class="text-2xl font-black italic text-white">{{ count($etudiants) }}</h3>
                </div>
                <div class="glass-card p-6 rounded-[2rem] border-l-4 border-l-yellow-500">
                    <p class="text-white/40 text-[9px] uppercase font-black tracking-widest mb-1">Rendus en attente</p>
                    <h3 class="text-2xl font-black italic text-white">{{ count($rendus) }}</h3>
                </div>
                <div class="glass-card p-6 rounded-[2rem] border-l-4 border-l-green-500">
                    <p class="text-white/40 text-[9px] uppercase font-black tracking-widest mb-1">Briefs Validés</p>
                    <h3 class="text-2xl font-black italic text-white">85%</h3>
                </div>
            </div>

            <section class="mb-8 animate-fade-in" style="animation-delay: 0.2s;">
                <div class="flex justify-between items-center mb-6 px-4">
                    <h2 class="text-cyan-400 font-black uppercase tracking-[0.3em] text-lg italic"><i class="fas fa-file-invoice mr-3"></i>Briefs Récents</h2>
                    <button onclick="toggleModal('BriefModal')" class="bg-white text-black font-black px-6 py-3 rounded-xl hover:bg-cyan-400 transition-all uppercase tracking-widest text-[9px] flex items-center gap-2 shadow-[0_0_20px_rgba(255,255,255,0.1)]">
                        <i class="fas fa-plus"></i> Nouveau Brief
                    </button>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    @foreach($briefs as $brief)
                        @if($brief->formateur_id === auth()->user()->id)
                        <div class="glass-card p-8 rounded-[2.5rem] group hover:border-cyan-400/50 transition-all duration-500 relative overflow-hidden">
                            <div class="absolute top-0 right-0 p-6">
                                <span class="px-3 py-1 bg-green-500/10 text-green-400 rounded-full text-[8px] font-black uppercase tracking-widest border border-green-500/20">Actif</span>
                            </div>
                            <h4 class="text-xl font-black text-white uppercase mb-3 group-hover:text-cyan-400 transition-colors italic">{{ $brief->nom }}</h4>
                            <div class="space-y-2 text-[11px] text-white/70">
                                <p><span class="text-cyan-400 font-bold">Type :</span> {{ $brief->type }}</p>
                                <p><span class="text-cyan-400 font-bold">Début :</span> {{ $brief->date_debut }} <span class="mx-1">→</span> <span class="text-cyan-400 font-bold">Fin :</span> {{ $brief->date_fin }}</p>
                            </div>
                            <div class="flex items-center justify-between pt-6 mt-6 border-t border-white/5">
                                <div class="px-3 py-1 rounded-full bg-cyan-400/10 text-cyan-300 text-[9px] font-black uppercase tracking-widest border border-cyan-400/20">En Cours</div>
                            </div>
                        </div>
                        @endif
                    @endforeach
                </div>
            </section>

            <section id="students-list" class="animate-fade-in mt-12 mb-8">
                <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-6 px-4">
                    <h2 class="text-cyan-400 font-black uppercase tracking-[0.3em] text-xl italic"><i class="fas fa-user-graduate mr-3"></i>Promotion Active</h2>
                    <button onclick="toggleModal('AssignStudentModal')" class="bg-cyan-400 text-black font-black px-6 py-3 rounded-xl hover:scale-105 transition-all uppercase tracking-widest text-[10px] flex items-center gap-2">
                        <i class="fas fa-user-plus"></i> Assigner Apprenants
                    </button>
                </div>
                <div class="glass-card rounded-[2.5rem] overflow-hidden border border-white/5 shadow-xl">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="text-cyan-400/60 text-[10px] uppercase tracking-[0.2em] border-b border-white/5 bg-white/[0.02]">
                                    <th class="p-8">Apprenant</th>
                                    <th class="p-8">Email</th>
                                    <th class="p-8">Username</th>
                                    <th class="p-8">Classe</th>
                                </tr>
                            </thead>
                            <tbody class="text-white/80">
                                @foreach($etudiants as $etudiant)
                                <tr class="border-b border-white/5 hover:bg-white/[0.02] transition-all">
                                    <td class="p-8 font-black uppercase text-xs italic">{{ $etudiant->user->firstname }} {{ $etudiant->user->lastname }}</td>
                                    <td class="p-8 text-xs">{{ $etudiant->user->email }}</td>
                                    <td class="p-8 text-xs italic text-cyan-400/60">{{ $etudiant->user->username }}</td>
                                    <td class="p-8"><span class="bg-white/5 px-3 py-1 rounded-lg text-[10px] font-bold border border-white/10 uppercase">{{ $etudiant->classe->nom }}</span></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>

            <section class="mb-8 animate-fade-in mt-12" style="animation-delay: 0.4s;">
                <div class="mb-6 px-4">
                    <h2 class="text-cyan-400 font-black uppercase tracking-[0.3em] text-lg italic">
                        <i class="fas fa-history mr-3"></i>Historique des Rendus
                    </h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                    @foreach($rendus as $rendu)
                    <div class="glass-card p-6 rounded-[2rem] border-t-2 border-cyan-400/30 hover:border-cyan-400 transition-all duration-300 shadow-md">
                        <div class="flex justify-between items-center mb-4">
                            <div class="w-10 h-10 rounded-xl bg-cyan-400/10 flex items-center justify-center text-cyan-400 border border-cyan-400/20">
                                <i class="fab fa-github text-xl"></i>
                            </div>
                            <h3 class="text-[10px] text-cyan-400 font-black uppercase tracking-[0.2em] italic">{{ $rendu->text }}</h3>
                            <span class="px-3 py-1 bg-cyan-400/10 text-cyan-400 rounded-full text-[8px] font-black uppercase tracking-widest border border-cyan-400/20">Envoyé</span>
                        </div>
                        <h4 class="text-white font-black uppercase text-sm mb-1 italic truncate">{{ $rendu->description }}</h4>
                        <p class="text-[9px] text-white/40 font-bold uppercase tracking-widest mb-4">Soumis le : <span class="text-white/60">{{ $rendu->date_soumission }}</span></p>
                        <div class="space-y-3 mb-4">
                            <a href="{{ $rendu->link }}" target="_blank" class="flex items-center justify-between p-3 bg-white/5 rounded-xl border border-white/5 hover:bg-white/10 transition-all group">
                                <span class="text-[10px] font-bold text-white/60 group-hover:text-cyan-400 uppercase italic">Voir le code</span>
                                <i class="fas fa-external-link-alt text-[10px] text-white/20 group-hover:text-cyan-400"></i>
                            </a>
                        </div>
                        <button onclick="toggleModal('CorrectionModal')" class="w-full bg-white text-black font-black py-4 rounded-2xl uppercase tracking-[0.3em] text-xs hover:bg-cyan-400 transition-all shadow-lg">Corriger le Brief</button>
                    </div>
                    @endforeach
                </div>
            </section>
        </main>
    </div>

    <div id="BriefModal" class="hidden fixed inset-0 bg-black/90 backdrop-blur-md z-[100] flex items-center justify-center p-4">
        <div class="glass-card w-full max-w-2xl p-8 md:p-10 rounded-[2.5rem] border border-cyan-400/30 animate-fade-in max-h-[90vh] overflow-y-auto">
            <div class="flex justify-between items-center mb-8">
                <h3 class="text-white text-2xl font-black italic uppercase tracking-tighter">Lancer <span class="text-cyan-400">Nouveau Brief</span></h3>
                <button onclick="toggleModal('BriefModal')" class="text-white/20 hover:text-white transition-all"><i class="fas fa-times text-xl"></i></button>
            </div>
            
            <form class="space-y-6" action="{{ route('formateur.createBrief') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-cyan-400/60 text-[9px] font-black uppercase tracking-widest ml-2 italic">Titre du Projet</label>
                        <input type="text" name="titre" required class="w-full bg-white/5 border border-white/10 rounded-2xl py-4 px-5 text-white outline-none focus:border-cyan-400/50 transition-all">
                    </div>
                    <div class="space-y-2">
                         <label class="text-cyan-400/60 text-[9px] font-black uppercase tracking-widest ml-2 italic">Sprint</label>
                         <select name="sprint_id" required class="w-full bg-slate-900 border border-white/10 rounded-2xl py-4 px-5 text-white outline-none focus:border-cyan-400/50 appearance-none">
                            <option value="">Choisir un Sprint...</option>
                            @foreach($sprints as $sprint)
                                <option value="{{ $sprint->id }}">{{ $sprint->nom }}</option>
                            @endforeach
                         </select>
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-cyan-400/60 text-[9px] font-black uppercase tracking-widest ml-2 italic">Technologies (Multi-choix)</label>
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                        @foreach(['HTML/CSS', 'Figma', 'JavaScript', 'PHP', 'MySQL', 'LINUX/SHELL', 'PostgreSQL', 'Docker', 'Bootstrap', 'Tailwind-CSS', 'React', 'Laravel'] as $tech)
                            <label class="flex items-center gap-3 cursor-pointer bg-white/5 p-3 rounded-xl border border-white/10 hover:border-cyan-400/40 transition-all">
                                <input type="checkbox" name="type[]" value="{{ $tech }}" class="accent-cyan-400 w-4 h-4">
                                <span class="text-white/70 text-[10px] font-bold uppercase">{{ $tech }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-cyan-400/60 text-[9px] font-black uppercase tracking-widest ml-2 italic">Compétences à valider</label>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        @foreach($competences as $competence)
                            <label class="flex items-center gap-3 cursor-pointer bg-white/5 p-3 rounded-xl border border-white/10 hover:border-cyan-400/40 transition-all">
                                <input type="checkbox" name="competence_ids[]" value="{{ $competence->id }}" class="accent-cyan-400 w-4 h-4">
                                <span class="text-white/70 text-[10px] font-bold uppercase truncate">{{ $competence->nom }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-cyan-400/60 text-[9px] font-black uppercase tracking-widest ml-2 italic">Description & Consignes</label>
                    <textarea rows="4" name="description" required class="w-full bg-white/5 border border-white/10 rounded-2xl py-4 px-5 text-white outline-none focus:border-cyan-400/50 transition-all placeholder:text-white/20" placeholder="Décrivez le projet..."></textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-cyan-400/60 text-[9px] font-black uppercase tracking-widest ml-2 italic">Date Debut</label>
                        <input type="date" name="date_debut" required class="w-full bg-white/5 border border-white/10 rounded-2xl py-4 px-5 text-white outline-none focus:border-cyan-400/50 transition-all">
                    </div>
                    <div class="space-y-2">
                        <label class="text-cyan-400/60 text-[9px] font-black uppercase tracking-widest ml-2 italic">Date Fin</label>
                        <input type="date" name="date_fin" required class="w-full bg-white/5 border border-white/10 rounded-2xl py-4 px-5 text-white outline-none focus:border-cyan-400/50 transition-all">
                    </div>
                </div>

                <button type="submit" class="w-full bg-cyan-400 text-black font-black py-5 rounded-2xl uppercase tracking-[0.3em] text-xs hover:bg-white transition-all duration-300 shadow-xl mt-4">
                    Diffuser le Brief aux Apprenants
                </button>
            </form>
        </div>
    </div>

    @foreach($rendus as $rendu)
    <div id="CorrectionModal" class="hidden fixed inset-0 bg-black/90 backdrop-blur-md z-[100] flex items-center justify-center p-4">
        <div class="glass-card w-full max-w-3xl p-8 md:p-10 rounded-[2.5rem] border border-cyan-400/30 animate-fade-in max-h-[90vh] overflow-y-auto">
            <div class="flex justify-between items-center mb-8 border-b border-white/5 pb-4">
                <h3 class="text-white text-2xl font-black italic uppercase tracking-tighter">
                    Évaluation : <span class="text-cyan-400">{{ $rendu->etudiants->first()->user->firstname ?? 'Apprenant' }}</span>
                </h3>
                <button onclick="toggleModal('CorrectionModal{{ $rendu->id }}')" class="text-white/20 hover:text-white transition-all">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            
            <form action="{{ route('formateur.correction') }}" method="POST" class="space-y-8">
                @csrf
                <input type="hidden" name="rendu_id" value="{{ $rendu->id }}">
                <input type="hidden" name="etudiant_id" value="{{ $rendu->etudiants->first()->user->id }}">
                <div class="space-y-3">
                    <label class="text-cyan-400 text-[10px] font-black uppercase tracking-widest italic">Feedback & Commentaire</label>
                    <textarea name="commentaire" rows="4" required class="w-full bg-white/5 border border-white/10 rounded-2xl p-5 text-white outline-none focus:border-cyan-400/50 transition-all" placeholder="Points forts..."></textarea>
                </div>
                
                <div class="space-y-4">
                    <label class="text-cyan-400 text-[10px] font-black uppercase tracking-widest italic block mb-4">Grille de Compétences</label>
                    
                    <div class="space-y-3">
                    @foreach($rendu->briefs as $brief)
                        @foreach($brief->competences as $cp)
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between p-4 bg-white/5 rounded-2xl border border-white/5 hover:border-cyan-400/20 transition-all gap-4">
                                <span class="text-xs font-bold uppercase italic text-white/80">
                                    {{ $cp->nom }}
                                </span>
                                
                                <input type="hidden" name="competences[]" value="{{ $cp->id }}">
                                <input type="hidden" name="brief_id" value="{{ $brief->id }}">
                                <div class="flex gap-2">
                                    @foreach(['IMITER', 'ADAPTER', 'TRANSPOSER'] as $level)
                                    <label class="cursor-pointer flex-1 sm:flex-none text-center">
                                        <input type="radio" name="levels" value="{{ $level }}" class="hidden peer" required>
                                        <span class="block px-3 py-2 border border-white/10 rounded-xl text-[8px] md:text-[9px] font-black text-white/30 peer-checked:bg-cyan-400 peer-checked:text-black peer-checked:border-cyan-400 transition-all uppercase italic">
                                            {{ $level }}
                                        </span>
                                    </label>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                    </div>
                </div>
                
                <button type="submit" class="w-full bg-cyan-400 text-black font-black py-5 rounded-2xl uppercase tracking-[0.4em] text-xs hover:bg-white transition-all shadow-xl">
                    Valider l'Évaluation
                </button>
            </form>
        </div>
    </div>
    @endforeach
    <div id="AssignStudentModal" class="hidden fixed inset-0 bg-black/90 backdrop-blur-md z-[100] flex items-center justify-center p-4">
        <div class="glass-card w-full max-w-md p-8 rounded-[2.5rem] border border-cyan-400/30 animate-fade-in shadow-2xl">
            <div class="flex justify-between items-center mb-8">
                <h3 class="text-white text-xl font-black italic uppercase tracking-tighter">Assigner <span class="text-cyan-400">Apprenants</span></h3>
                <button onclick="toggleModal('AssignStudentModal')" class="text-white/20 hover:text-white transition-all"><i class="fas fa-times text-xl"></i></button>
            </div>
            
            <form action="{{ route('formateur.assign_students') }}" method="POST" class="space-y-6">
                @csrf
                <div class="space-y-2">
                    <label class="text-cyan-400/60 text-[9px] font-black uppercase tracking-widest ml-2 italic">Étudiant</label>
                    <select name="student_id" required class="w-full bg-slate-900 border border-white/10 rounded-2xl py-4 px-5 text-white outline-none focus:border-cyan-400/50 appearance-none">
                        <option value="">Sélectionner...</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->firstname }} {{ $user->lastname }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="space-y-2">
                    <label class="text-cyan-400/60 text-[9px] font-black uppercase tracking-widest ml-2 italic">Classe</label>
                    <select name="classes_id" required class="w-full bg-slate-900 border border-white/10 rounded-2xl py-4 px-5 text-white outline-none focus:border-cyan-400/50 appearance-none">
                        <option value="">Sélectionner...</option>
                        @foreach($classes as $classe)
                            <option value="{{ $classe->id }}">{{ $classe->nom }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="w-full bg-white text-black font-black py-4 rounded-2xl uppercase tracking-[0.3em] text-[10px] hover:bg-cyan-400 transition-all duration-300">
                    Confirmer l'intégration
                </button>
            </form>
        </div>
    </div>

    <script>
        function toggleModal(id) {
            const modal = document.getElementById(id);
            if (modal) {
                modal.classList.toggle('hidden');
                // Prevent scrolling when modal is open
                if(!modal.classList.contains('hidden')) {
                    document.body.style.overflow = 'hidden';
                } else {
                    document.body.style.overflow = 'auto';
                }
            }
        }

        window.onclick = function(event) {
            if (event.target.id.includes('Modal')) {
                toggleModal(event.target.id);
            }
        }
    </script>
</body>
</html>