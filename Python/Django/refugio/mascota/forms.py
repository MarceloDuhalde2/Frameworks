from django import forms
from mascota.models import Mascota
class MascotaForm(forms.ModelForm):
    class Meta:
        model = Mascota

        fields = [  "nombre",
                    "sexo",
                    "edad_aproximada",
                    "fecha_rescate",
                    "persona",
                    "vacuna"]

        labels = {  "nombre":"Nombre", 
                    "sexo":"Sexo",
                    "edad_aproximada":"Edad Aproximada",
                    "fecha_rescate":"Fecha De Rescate",
                    "persona":"Persona",
                    "vacuna":"Vacuna"}

        widgets = { "nombre": forms.TextInput(attrs={"class":"form-control"}),
                    "sexo": forms.TextInput(attrs={"class":"form-control"}),
                    "edad_aproximada": forms.TextInput(attrs={"class":"form-control"}),
                    "fecha_rescate": forms.TextInput(attrs={"class":"form-control"}),
                    "persona": forms.Select(attrs={"class":"form-control"}),
                    "vacuna": forms.CheckboxSelectMultiple()}
                    