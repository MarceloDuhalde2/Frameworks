from django import forms
from adopcion.models import Persona, Solicitud
class PersonaForm(forms.ModelForm):
    class Meta:
        model = Persona

        fields = [  "nombre",
                    "apellidos",
                    "edad",
                    "email",
                    "domicilio"]

        labels = {  "nombre":"Nombre", 
                    "apellidos":"Apellido",
                    "edad":"Edad",
                    "email":"Email",
                    "domicilio":"Domicilio"}

        widgets = { "nombre": forms.TextInput(attrs={"class":"form-control"}),
                    "apellidos": forms.TextInput(attrs={"class":"form-control"}),
                    "edad": forms.TextInput(attrs={"class":"form-control"}),
                    "email": forms.TextInput(attrs={"class":"form-control"}),
                    "domicilio": forms.Textarea(attrs={"class":"form-control"})}

class SolicitudForm(forms.ModelForm):
    class Meta:
        model = Solicitud

        fields = [  "numero_mascotas",
                    "razones"]

        labels = {  "numero_mascotas":"Numero de Mascotas", 
                    "razones":"Razones"}

        widgets = { "numero_mascotas": forms.TextInput(attrs={"class":"form-control"}),
                    "razones": forms.Textarea(attrs={"class":"form-control"})}