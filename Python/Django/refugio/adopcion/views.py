from django.shortcuts import render
from django.http import HttpResponse, HttpResponseRedirect
from django.views.generic import ListView, CreateView
from adopcion.models import Solicitud
from adopcion.forms import SolicitudForm, PersonaForm
from django.urls import reverse_lazy
# Create your views here.

def index(request):
    return HttpResponse("soy principal de adopcion")

class SolicitudListView(ListView):
    model = Solicitud
    template_name = "adopcion/solicitud_list.html"

class SolicitudCreateView(CreateView):
    model = Solicitud
    form_class = SolicitudForm
    template_name = "adopcion/solicitud_form.html"
    second_form_class = PersonaForm
    success_url = reverse_lazy("adopcion:solicitud_listar")

    def get_context_data(self, **kwargs):
        context = super(SolicitudCreateView, self).get_context_data(**kwargs)
        if "form" not in context:
            context["form"] = self.form_class(self.request.GET)
        if "form2" not in context:
            context["form2"] = self.second_form_class(self.request.GET)
        return context
    
    def post(self, request, *args, **kwargs):
        self.object = self.get_object
        form = self.form_class(request.POST)
        form2 = self.second_form_class(request.POST)
        if form.is_valid() and form2.is_valid():
            solicitud = form.save(commit=False)
            solicitud.persona = form2.save()
            solicitud.save()
            return HttpResponseRedirect(self.get_success_url())        
        else:
            return self.render_to_response(self.get_context_data(form=form, form2=form2))