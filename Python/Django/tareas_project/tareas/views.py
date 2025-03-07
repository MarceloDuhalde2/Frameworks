from django import forms
from django.shortcuts import redirect, render
from django.views.generic import ListView, DetailView
from .models import Tarea
from django.contrib.auth.decorators import login_required
from django.utils.decorators import method_decorator
from django.views.generic.edit import CreateView
from django.contrib.auth.mixins import LoginRequiredMixin
from rest_framework import viewsets
from .serializers import TareaSerializer
from rest_framework.permissions import IsAuthenticated  # Importa la clase

# FBV: Lista de tareas
def tarea_lista(request):
    tareas = Tarea.objects.all()
    return render(request, 'tareas/tarea_lista.html', {'tareas': tareas})

# CBV: Lista de tareas
class TareaListView(ListView):
    model = Tarea
    template_name = 'tareas/tarea_lista.html'
    context_object_name = 'tareas'

    def get_queryset(self):
        return Tarea.objects.select_related('usuario').prefetch_related('etiquetas')

# CBV: Detalle de tarea
class TareaDetailView(DetailView):
    model = Tarea
    template_name = 'tareas/tarea_detail.html'

# Formulario para FBV
class TareaForm(forms.ModelForm):
    class Meta:
        model = Tarea
        fields = ['titulo', 'descripcion', 'completada', 'etiquetas']

    def __init__(self, *args, **kwargs):
        super().__init__(*args, **kwargs)
        self.fields['etiquetas'].required = False  # Asegura que no sea obligatorio

    def clean_etiquetas(self):
        etiquetas = self.cleaned_data.get('etiquetas')
        # Si no se envían etiquetas o es una cadena vacía, devolver una lista vacía
        if etiquetas is None or etiquetas == '':
            return []
        return etiquetas

# FBV: Crear tarea
@login_required
def tarea_crear(request):
    if request.method == 'POST':
        form = TareaForm(request.POST)
        if form.is_valid():
            tarea = form.save(commit=False)
            tarea.usuario = request.user
            tarea.save()
            form.save_m2m()
            return redirect('tareas:tarea_lista')
    else:
        form = TareaForm()
    return render(request, 'tareas/tarea_form.html', {'form': form})

# CBV: Crear tarea (opcional para practicar)
@method_decorator(login_required, name='dispatch')
class TareaCreateView(LoginRequiredMixin, CreateView):
    model = Tarea
    fields = ['titulo', 'descripcion', 'completada', 'etiquetas']
    template_name = 'tareas/tarea_form.html'
    success_url = '/tareas/'

    def form_valid(self, form):
        form.instance.usuario = self.request.user
        return super().form_valid(form)

class TareaViewSet(viewsets.ModelViewSet):
    queryset = Tarea.objects.all()
    serializer_class = TareaSerializer
    permission_classes = [IsAuthenticated]

    def perform_create(self, serializer):
        serializer.save(usuario=self.request.user)