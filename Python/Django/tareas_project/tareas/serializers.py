from rest_framework import serializers
from .models import Tarea, Etiqueta

class EtiquetaSerializer(serializers.ModelSerializer):
    class Meta:
        model = Etiqueta
        fields = ['id', 'nombre']

class TareaSerializer(serializers.ModelSerializer):
    etiquetas = EtiquetaSerializer(many=True, read_only=True)

    class Meta:
        model = Tarea
        fields = ['id', 'titulo', 'descripcion', 'completada', 'usuario', 'etiquetas', 'fecha_creacion']
        read_only_fields = ['usuario', 'fecha_creacion']  # Añade estos campos como de solo lectura

    def create(self, validated_data):
        # Elimina 'etiquetas' del validated_data si está presente, ya que se maneja por separado
        etiquetas_data = validated_data.pop('etiquetas', [])
        tarea = Tarea.objects.create(**validated_data)
        tarea.etiquetas.set(etiquetas_data)
        return tarea